import React, { useState, useEffect } from 'react';

const AlumniDirectory = () => {
    const [alumni, setAlumni] = useState([]);
    const [loading, setLoading] = useState(true);
    const [search, setSearch] = useState('');
    const [filters, setFilters] = useState({
        program: '',
        graduation_year: '',
        industry: '',
        location: ''
    });
    const [viewMode, setViewMode] = useState('grid');

    useEffect(() => {
        fetchAlumni();
    }, [search, filters]);

    const fetchAlumni = async () => {
        try {
            setLoading(true);
            const params = new URLSearchParams({
                search,
                ...filters
            });
            
            const response = await fetch(`/api/alumni?${params}`);
            const data = await response.json();
            setAlumni(data.data || []);
        } catch (error) {
            console.error('Error fetching alumni:', error);
        } finally {
            setLoading(false);
        }
    };

    const handleConnect = async (alumniId) => {
        try {
            const response = await fetch(`/api/alumni/${alumniId}/connect`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });
            
            if (response.ok) {
                alert('Connection request sent!');
            }
        } catch (error) {
            console.error('Error sending connection request:', error);
        }
    };

    if (loading) {
        return React.createElement('div', {className: 'text-center py-8'}, [
            React.createElement('div', {
                className: 'spinner-border',
                role: 'status'
            }, React.createElement('span', {className: 'visually-hidden'}, 'Loading...'))
        ]);
    }

    const yearOptions = Array.from({length: 20}, (_, i) => new Date().getFullYear() - i).map(year => 
        React.createElement('option', {key: year, value: year}, year)
    );

    const alumniCards = alumni.map(person => 
        React.createElement('div', {
            key: person.id,
            className: viewMode === 'grid' ? 'col-md-4 mb-4' : 'mb-3'
        }, React.createElement('div', {className: 'card h-100'}, [
            React.createElement('div', {className: 'card-body'}, [
                React.createElement('div', {className: 'd-flex align-items-center mb-3'}, [
                    React.createElement('img', {
                        src: person.profile_picture || '/images/default-avatar.png',
                        className: 'rounded-circle me-3',
                        width: 50,
                        height: 50,
                        alt: person.first_name
                    }),
                    React.createElement('div', {}, [
                        React.createElement('h5', {className: 'card-title mb-0'}, 
                            `${person.first_name} ${person.last_name}`
                        ),
                        React.createElement('small', {className: 'text-muted'}, 
                            person.current_position || ''
                        )
                    ])
                ]),
                React.createElement('p', {className: 'card-text'}, 
                    React.createElement('small', {}, [
                        React.createElement('strong', {}, 'Program: '), 
                        person.program || 'N/A',
                        React.createElement('br'),
                        React.createElement('strong', {}, 'Class: '), 
                        person.graduation_year || 'N/A',
                        React.createElement('br'),
                        React.createElement('strong', {}, 'Location: '), 
                        person.current_location || 'N/A'
                    ])
                ),
                React.createElement('button', {
                    className: 'btn btn-primary btn-sm',
                    onClick: () => handleConnect(person.id)
                }, [
                    React.createElement('i', {className: 'fas fa-user-plus'}),
                    ' Connect'
                ])
            ])
        ]))
    );

    return React.createElement('div', {className: 'alumni-directory'}, [
        // Search and Filters
        React.createElement('div', {className: 'row mb-4'}, [
            React.createElement('div', {className: 'col-md-6'}, 
                React.createElement('input', {
                    type: 'text',
                    className: 'form-control',
                    placeholder: 'Search alumni...',
                    value: search,
                    onChange: (e) => setSearch(e.target.value)
                })
            ),
            React.createElement('div', {className: 'col-md-6'}, 
                React.createElement('div', {className: 'btn-group float-end'}, [
                    React.createElement('button', {
                        className: viewMode === 'grid' ? 'btn btn-primary' : 'btn btn-outline-primary',
                        onClick: () => setViewMode('grid')
                    }, [
                        React.createElement('i', {className: 'fas fa-th'}),
                        ' Grid'
                    ]),
                    React.createElement('button', {
                        className: viewMode === 'list' ? 'btn btn-primary' : 'btn btn-outline-primary',
                        onClick: () => setViewMode('list')
                    }, [
                        React.createElement('i', {className: 'fas fa-list'}),
                        ' List'
                    ])
                ])
            )
        ]),

        // Filters
        React.createElement('div', {className: 'row mb-4'}, [
            React.createElement('div', {className: 'col-md-3'}, 
                React.createElement('select', {
                    className: 'form-select',
                    value: filters.program,
                    onChange: (e) => setFilters({...filters, program: e.target.value})
                }, [
                    React.createElement('option', {value: ''}, 'All Programs'),
                    React.createElement('option', {value: 'Law'}, 'Law'),
                    React.createElement('option', {value: 'International Law'}, 'International Law'),
                    React.createElement('option', {value: 'Business Law'}, 'Business Law')
                ])
            ),
            React.createElement('div', {className: 'col-md-3'}, 
                React.createElement('select', {
                    className: 'form-select',
                    value: filters.graduation_year,
                    onChange: (e) => setFilters({...filters, graduation_year: e.target.value})
                }, [
                    React.createElement('option', {value: ''}, 'All Years'),
                    ...yearOptions
                ])
            ),
            React.createElement('div', {className: 'col-md-3'}, 
                React.createElement('select', {
                    className: 'form-select',
                    value: filters.industry,
                    onChange: (e) => setFilters({...filters, industry: e.target.value})
                }, [
                    React.createElement('option', {value: ''}, 'All Industries'),
                    React.createElement('option', {value: 'Legal'}, 'Legal'),
                    React.createElement('option', {value: 'Government'}, 'Government'),
                    React.createElement('option', {value: 'Corporate'}, 'Corporate'),
                    React.createElement('option', {value: 'NGO'}, 'NGO')
                ])
            ),
            React.createElement('div', {className: 'col-md-3'}, 
                React.createElement('input', {
                    type: 'text',
                    className: 'form-control',
                    placeholder: 'Location...',
                    value: filters.location,
                    onChange: (e) => setFilters({...filters, location: e.target.value})
                })
            )
        ]),

        // Alumni Grid/List
        React.createElement('div', {className: viewMode === 'grid' ? 'row' : ''}, 
            alumniCards.length > 0 ? alumniCards : 
            React.createElement('div', {className: 'text-center py-8'}, 
                React.createElement('p', {className: 'text-muted'}, 'No alumni found matching your criteria.')
            )
        )
    ]);
};

export default AlumniDirectory;