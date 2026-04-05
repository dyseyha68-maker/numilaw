import React, { useState, useEffect } from 'react';

const ModernLanding = () => {
    const [locale, setLocale] = useState(window.Laravel?.locale || 'en');
    const [isVisible, setIsVisible] = useState({});
    const [countersAnimated, setCountersAnimated] = useState(false);

    const t = (en, km) => locale === 'km' ? km : en;

    useEffect(() => {
        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        setIsVisible((prev) => ({ ...prev, [entry.target.id]: true }));
                    }
                });
            },
            { threshold: 0.1 }
        );

        document.querySelectorAll('[id]').forEach((el) => observer.observe(el));

        const counterObserver = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting && !countersAnimated) {
                        setCountersAnimated(true);
                    }
                });
            },
            { threshold: 0.5 }
        );

        const counterEl = document.getElementById('counter-section');
        if (counterEl) counterObserver.observe(counterEl);

        return () => {
            observer.disconnect();
            counterObserver.disconnect();
        };
    }, [countersAnimated]);

    const animateCounter = (elementId, target) => {
        let current = 0;
        const increment = target / 50;
        const element = document.getElementById(elementId);
        if (!element) return;

        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                element.textContent = target + '+';
                clearInterval(timer);
            } else {
                element.textContent = Math.floor(current) + '+';
            }
        }, 30);
    };

    useEffect(() => {
        if (countersAnimated) {
            animateCounter('counter-faculty', 50);
            animateCounter('counter-students', 2500);
            animateCounter('counter-graduates', 1200);
            animateCounter('counter-publications', 100);
        }
    }, [countersAnimated]);

    const featuredArticles = window.Laravel?.featuredArticles || [];
    const upcomingEvents = window.Laravel?.upcomingEvents || [];

    const styles = {
        heroSection: {
            background: 'linear-gradient(135deg, #003A46 0%, #004d5c 50%, #005f6b 100%)',
            position: 'relative',
            overflow: 'hidden',
            minHeight: '85vh',
            display: 'flex',
            alignItems: 'center',
        },
        heroGrid: {
            position: 'absolute',
            top: 0,
            left: 0,
            right: 0,
            bottom: 0,
            backgroundImage: 'linear-gradient(rgba(255,255,255,0.03) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.03) 1px, transparent 1px)',
            backgroundSize: '60px 60px',
        },
        heroDiagonal: {
            position: 'absolute',
            top: 0,
            right: 0,
            width: '50%',
            height: '100%',
            background: 'linear-gradient(180deg, rgba(0,170,204,0.15) 0%, transparent 50%)',
            clipPath: 'polygon(30% 0, 100% 0, 100% 100%, 0% 100%)',
        },
        heroBadge: {
            display: 'inline-flex',
            alignItems: 'center',
            background: 'rgba(255,255,255,0.15)',
            backdropFilter: 'blur(10px)',
            border: '1px solid rgba(255,255,255,0.2)',
            padding: '0.5rem 1.25rem',
            borderRadius: '50px',
            color: '#fff',
            fontSize: '0.875rem',
            fontWeight: 500,
            marginBottom: '1.5rem',
            animation: 'slideDown 0.6s ease-out',
        },
        heroTitle: {
            fontSize: 'clamp(2.5rem, 5vw, 3.5rem)',
            fontWeight: 700,
            lineHeight: 1.15,
            color: '#fff',
            marginBottom: '1rem',
        },
        heroSubtitle: {
            fontSize: '1.25rem',
            color: 'rgba(255,255,255,0.85)',
            marginBottom: '1rem',
            fontWeight: 400,
        },
        heroDescription: {
            fontSize: '1.1rem',
            color: 'rgba(255,255,255,0.7)',
            maxWidth: '550px',
            lineHeight: 1.7,
            marginBottom: '2rem',
        },
        heroBtnPrimary: {
            background: '#fff',
            color: '#003A46',
            border: 'none',
            padding: '1rem 2rem',
            borderRadius: '8px',
            fontWeight: 600,
            fontSize: '1rem',
            display: 'inline-flex',
            alignItems: 'center',
            gap: '0.5rem',
            transition: 'all 0.3s ease',
            textDecoration: 'none',
            cursor: 'pointer',
        },
        heroBtnSecondary: {
            background: 'transparent',
            color: '#fff',
            border: '2px solid rgba(255,255,255,0.5)',
            padding: '1rem 2rem',
            borderRadius: '8px',
            fontWeight: 600,
            fontSize: '1rem',
            display: 'inline-flex',
            alignItems: 'center',
            gap: '0.5rem',
            transition: 'all 0.3s ease',
            textDecoration: 'none',
            cursor: 'pointer',
        },
        heroInfoCard: {
            background: 'rgba(255,255,255,0.98)',
            borderRadius: '16px',
            padding: '2rem',
            boxShadow: '0 25px 50px rgba(0,0,0,0.25)',
        },
        heroEventDate: {
            width: '50px',
            height: '50px',
            background: 'linear-gradient(135deg, #003A46, #005f6b)',
            borderRadius: '10px',
            display: 'flex',
            flexDirection: 'column',
            alignItems: 'center',
            justifyContent: 'center',
            color: '#fff',
            marginRight: '1rem',
            flexShrink: 0,
        },
        statCard: {
            background: 'white',
            borderRadius: '20px',
            padding: '2rem',
            textAlign: 'center',
            transition: 'all 0.4s ease',
            border: 'none',
            boxShadow: '0 10px 40px rgba(0,0,0,0.08)',
            position: 'relative',
            overflow: 'hidden',
        },
        featuredCard: {
            border: 'none',
            borderRadius: '20px',
            overflow: 'hidden',
            transition: 'all 0.4s ease',
            boxShadow: '0 10px 40px rgba(0,0,0,0.08)',
            background: 'white',
            height: '100%',
        },
        programCard: {
            border: 'none',
            borderRadius: '24px',
            padding: '2.5rem 2rem',
            textAlign: 'center',
            transition: 'all 0.4s ease',
            background: 'white',
            boxShadow: '0 10px 40px rgba(0,0,0,0.08)',
            height: '100%',
            position: 'relative',
            overflow: 'hidden',
        },
        ctaModern: {
            background: '#003A46',
            position: 'relative',
            overflow: 'hidden',
            padding: '80px 0',
        },
    };

    const keyframes = `
        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeInRight {
            from { opacity: 0; transform: translateX(30px); }
            to { opacity: 1; transform: translateX(0); }
        }
    `;

    return (
        <>
            <style>{keyframes}</style>
            
            <section style={styles.heroSection}>
                <div style={styles.heroGrid}></div>
                <div style={styles.heroDiagonal}></div>
                <div className="container position-relative" style={{ zIndex: 2 }}>
                    <div className="row align-items-center">
                        <div className="col-lg-7">
                            <div style={{ animation: 'slideUp 0.8s ease-out' }}>
                                <div style={styles.heroBadge}>
                                    <i className="bi bi-mortarboard-fill me-2"></i>
                                    {t("Cambodia's Premier Law Faculty", "ស្ថាប័នអប់រំផ្នែកច្បាប់លើកស្ទួយ")}
                                </div>
                                
                                <h1 style={styles.heroTitle}>
                                    {t("Excellence in", "ភាពល្អឯក")} <br/>
                                    {t("Legal Education", "ក្នុងការអប់រំផ្នែកច្បាប់")}
                                </h1>
                                
                                <h2 style={styles.heroSubtitle}>
                                    {t("Building tomorrow's legal leaders", "កសាងមេដឹកនាំផ្នែកច្បាប់នៃថ្ងៃស្អែក")}
                                </h2>
                                
                                <p style={styles.heroDescription}>
                                    {t("Welcome to Cambodia's premier institution for legal studies with modern curriculum and expert faculty", 
                                       "សូមស្វាគមន៍មកកាន់ស្ថាប័នអប់រំផ្នែកច្បាប់លើកស្ទួយរបស់កម្ពុជា ជាមួយនឹងកម្មវិធីសិក្សាទាន់សម័យ និងគ្រូបង្រៀន")}
                                </p>

                                <div className="d-flex gap-3 flex-wrap">
                                    <a href={window.Laravel?.routes?.articles || '#'} 
                                       style={styles.heroBtnPrimary}
                                       onMouseOver={(e) => {
                                           e.target.style.transform = 'translateY(-2px)';
                                           e.target.style.boxShadow = '0 10px 30px rgba(0,0,0,0.2)';
                                       }}
                                       onMouseOut={(e) => {
                                           e.target.style.transform = 'translateY(0)';
                                           e.target.style.boxShadow = 'none';
                                       }}>
                                        <i className="bi bi-newspaper"></i>
                                        {t("News", "ព័ត៌មាន")}
                                    </a>
                                    <a href={window.Laravel?.routes?.events || '#'} 
                                       style={styles.heroBtnSecondary}
                                       onMouseOver={(e) => {
                                           e.target.style.background = 'rgba(255,255,255,0.1)';
                                           e.target.style.borderColor = '#fff';
                                       }}
                                       onMouseOut={(e) => {
                                           e.target.style.background = 'transparent';
                                           e.target.style.borderColor = 'rgba(255,255,255,0.5)';
                                       }}>
                                        <i className="bi bi-calendar-event"></i>
                                        {t("Events", "ព្រឹត្តិការណ៍")}
                                    </a>
                                    <a href={window.Laravel?.routes?.about || '#'} 
                                       style={styles.heroBtnSecondary}
                                       onMouseOver={(e) => {
                                           e.target.style.background = 'rgba(255,255,255,0.1)';
                                           e.target.style.borderColor = '#fff';
                                       }}
                                       onMouseOut={(e) => {
                                           e.target.style.background = 'transparent';
                                           e.target.style.borderColor = 'rgba(255,255,255,0.5)';
                                       }}>
                                        <i className="bi bi-info-circle"></i>
                                        {t("About", "អំពី")}
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <div className="col-lg-5">
                            <div style={{ animation: 'fadeInRight 0.8s ease-out 0.4s both' }}>
                                <div style={styles.heroInfoCard}>
                                    <h4 style={{ color: '#003A46', fontWeight: 700, marginBottom: '1.5rem' }}>
                                        <i className="bi bi-calendar-check me-2"></i>
                                        {t("Important Dates", "កាលបរិច្ឆេទសំខាន់")}
                                    </h4>
                                    
                                    {upcomingEvents.length > 0 ? upcomingEvents.slice(0, 3).map((event, index) => (
                                        <div key={index} className="d-flex align-items-center p-3 rounded-3 mb-3" 
                                             style={{ background: '#f8fafc', transition: 'all 0.3s ease', cursor: 'pointer' }}
                                             onMouseOver={(e) => {
                                                 e.currentTarget.style.background = '#e2e8f0';
                                                 e.currentTarget.style.transform = 'translateX(5px)';
                                             }}
                                             onMouseOut={(e) => {
                                                 e.currentTarget.style.background = '#f8fafc';
                                                 e.currentTarget.style.transform = 'translateX(0)';
                                             }}>
                                            <div style={styles.heroEventDate}>
                                                <span style={{ fontSize: '1.1rem', fontWeight: 700, lineHeight: 1 }}>
                                                    {new Date(event.start_datetime).getDate()}
                                                </span>
                                                <span style={{ fontSize: '0.65rem', textTransform: 'uppercase' }}>
                                                    {new Date(event.start_datetime).toLocaleString('en', { month: 'short' })}
                                                </span>
                                            </div>
                                            <div>
                                                <h6 style={{ fontSize: '0.95rem', fontWeight: 600, color: '#1e293b', marginBottom: '0.25rem' }}>
                                                    {(locale === 'km' ? event.title_km : event.title_en)?.substring(0, 35)}
                                                </h6>
                                                <span style={{ fontSize: '0.8rem', color: '#64748b' }}>
                                                    <i className="bi bi-geo-alt me-1"></i> {event.location}
                                                </span>
                                            </div>
                                        </div>
                                    )) : (
                                        <div className="text-center py-4 text-muted">
                                            <i className="bi bi-calendar-x fs-2"></i>
                                            <p className="mb-0 mt-2">{t("No upcoming events", "គ្មានព្រឹត្តិការណ៍")}</p>
                                        </div>
                                    )}
                                    
                                    <div className="d-flex gap-4 pt-4 mt-3" style={{ borderTop: '1px solid #e2e8f0' }}>
                                        {[
                                            { number: '50+', label: t('Faculty', 'បណ្ឌិត') },
                                            { number: '2,500+', label: t('Students', 'និស្សិត') },
                                            { number: '30+', label: t('Years', 'ឆ្នាំ') },
                                        ].map((stat, i) => (
                                            <div key={i} className="text-center">
                                                <div style={{ fontSize: '1.5rem', fontWeight: 700, color: '#003A46' }}>{stat.number}</div>
                                                <div style={{ fontSize: '0.75rem', color: '#64748b', textTransform: 'uppercase' }}>{stat.label}</div>
                                            </div>
                                        ))}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="counter-section" className="py-5" style={{ background: 'linear-gradient(180deg, #f8fafc 0%, #e2e8f0 100%)' }}>
                <div className="container">
                    <div className="row g-4">
                        {[
                            { icon: 'bi-people-fill', number: '50+', label: t('Faculty Members', 'បណ្ឌិត្យសភា'), color: '#0284c7', bg: '#e0f2fe' },
                            { icon: 'bi-mortarboard-fill', number: '2,500+', label: t('Students', 'និស្សិត'), color: '#16a34a', bg: '#dcfce7' },
                            { icon: 'bi-award-fill', number: '1,200+', label: t('Graduates', 'និន្នាការ'), color: '#d97706', bg: '#fef3c7' },
                            { icon: 'bi-book-fill', number: '100+', label: t('Publications', 'ការផ្សាយ'), color: '#4f46e5', bg: '#e0e7ff' },
                        ].map((stat, index) => (
                            <div className="col-md-3" key={index}>
                                <div style={styles.statCard}
                                     onMouseOver={(e) => {
                                         e.currentTarget.style.transform = 'translateY(-10px)';
                                         e.currentTarget.style.boxShadow = '0 20px 60px rgba(0,0,0,0.15)';
                                     }}
                                     onMouseOut={(e) => {
                                         e.currentTarget.style.transform = 'translateY(0)';
                                         e.currentTarget.style.boxShadow = '0 10px 40px rgba(0,0,0,0.08)';
                                     }}>
                                    <div style={{ 
                                        width: 80, height: 80, borderRadius: '50%', 
                                        display: 'flex', alignItems: 'center', justifyContent: 'center',
                                        margin: '0 auto 1rem', fontSize: '2rem',
                                        background: stat.bg, color: stat.color,
                                        transition: 'all 0.4s ease'
                                    }}>
                                        <i className={stat.icon}></i>
                                    </div>
                                    <div id={`counter-${stat.label.split(' ')[0].toLowerCase()}`} 
                                         style={{ fontSize: '2.5rem', fontWeight: 700, color: '#003A46', marginBottom: '0.5rem' }}>
                                        0
                                    </div>
                                    <p className="text-muted mb-0">{stat.label}</p>
                                </div>
                            </div>
                        ))}
                    </div>
                </div>
            </section>

            <section className="py-5" style={{ background: 'white' }}>
                <div className="container">
                    <div className="row">
                        <div className="col-lg-8 mb-4">
                            <div className="d-flex justify-content-between align-items-center mb-4">
                                <div>
                                    <h2 style={{ color: '#003A46', fontWeight: 700, marginBottom: '0.5rem' }}>
                                        {t("Latest News & Articles", "ព័ត៌មាននិងអត្ថប្រចុងក្រោយ")}
                                    </h2>
                                    <p className="text-muted mb-0">Stay updated with our latest news and articles</p>
                                </div>
                                <a href={window.Laravel?.routes?.articles || '#'} 
                                   className="btn btn-outline-dark"
                                   style={{ borderRadius: '50px', padding: '0.75rem 1.5rem' }}>
                                    {t("View All", "មើលទាំងអស់")} <i className="bi bi-arrow-right ms-2"></i>
                                </a>
                            </div>
                            
                            <div className="row g-4">
                                {featuredArticles.length > 0 ? featuredArticles.slice(0, 4).map((article, index) => (
                                    <div className="col-md-6 mb-4" key={index}>
                                        <div style={styles.featuredCard}
                                             onMouseOver={(e) => {
                                                 e.currentTarget.style.transform = 'translateY(-10px)';
                                                 e.currentTarget.style.boxShadow = '0 25px 60px rgba(0,0,0,0.15)';
                                             }}
                                             onMouseOut={(e) => {
                                                 e.currentTarget.style.transform = 'translateY(0)';
                                                 e.currentTarget.style.boxShadow = '0 10px 40px rgba(0,0,0,0.08)';
                                             }}>
                                            {article.featured_image ? (
                                                <img src={`/storage/${article.featured_image}`} 
                                                     alt={article.title}
                                                     style={{ height: '220px', objectFit: 'cover', width: '100%' }} />
                                            ) : (
                                                <div className="d-flex align-items-center justify-content-center bg-light" 
                                                     style={{ height: '220px' }}>
                                                    <i className="bi bi-newspaper display-4 text-muted"></i>
                                                </div>
                                            )}
                                            <div className="card-body p-4">
                                                <div className="d-flex align-items-center justify-content-between mb-3">
                                                    {article.category && (
                                                        <span style={{ 
                                                            background: '#e0f2fe', color: '#0284c7',
                                                            padding: '0.4rem 1rem', borderRadius: '20px',
                                                            fontSize: '0.75rem', fontWeight: 600 
                                                        }}>
                                                            {article.category.name}
                                                        </span>
                                                    )}
                                                    <small className="text-muted">
                                                        {new Date(article.published_at).toLocaleDateString('en', { month: 'short', day: 'numeric', year: 'numeric' })}
                                                    </small>
                                                </div>
                                                <h5 style={{ fontWeight: 700, marginBottom: '0.75rem', color: '#003A46' }}>
                                                    <a href={`/articles/${article.slug}`} 
                                                       style={{ textDecoration: 'none', color: 'inherit' }}
                                                       onMouseOver={(e) => e.target.style.color = '#00AACC'}
                                                       onMouseOut={(e) => e.target.style.color = '#003A46'}>
                                                        {article.title?.substring(0, 60)}
                                                    </a>
                                                </h5>
                                                <p className="text-muted small mb-3" style={{ lineHeight: 1.6 }}>
                                                    {article.content?.replace(/<[^>]*>/g, '').substring(0, 100)}...
                                                </p>
                                                <div className="d-flex align-items-center justify-content-between">
                                                    <div className="d-flex align-items-center">
                                                        <div className="rounded-circle bg-light d-flex align-items-center justify-content-center me-2" 
                                                             style={{ width: 32, height: 32 }}>
                                                            <i className="bi bi-person text-muted small"></i>
                                                        </div>
                                                        <small className="text-muted">{article.author?.name}</small>
                                                    </div>
                                                    <a href={`/articles/${article.slug}`}
                                                       className="btn btn-sm"
                                                       style={{ background: '#003A46', color: 'white', borderRadius: '20px' }}>
                                                        Read <i className="bi bi-arrow-right ms-1"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                )) : (
                                    <div className="col-12 text-center py-5">
                                        <i className="bi bi-newspaper text-muted fs-1"></i>
                                        <p className="text-muted mt-3">No articles found</p>
                                    </div>
                                )}
                            </div>
                        </div>
                        
                        <div className="col-lg-4">
                            <div className="mb-4">
                                <h3 className="h5 fw-bold mb-4" style={{ color: '#003A46' }}>
                                    <i className="bi bi-calendar-event me-2"></i> {t("Upcoming Events", "ព្រឹត្តិការណ៍ខាងម�ខ")}
                                </h3>
                                
                                {upcomingEvents.slice(0, 3).map((event, index) => (
                                    <div key={index} className="mb-3 p-3 rounded-3" 
                                         style={{ background: '#f8fafc', borderLeft: '4px solid #003A46',
                                                 transition: 'all 0.3s ease' }}
                                         onMouseOver={(e) => {
                                             e.currentTarget.style.transform = 'translateX(5px)';
                                             e.currentTarget.style.boxShadow = '0 5px 20px rgba(0,0,0,0.1)';
                                         }}
                                         onMouseOut={(e) => {
                                             e.currentTarget.style.transform = 'translateX(0)';
                                             e.currentTarget.style.boxShadow = 'none';
                                         }}>
                                        <h6 className="fw-bold mb-2" style={{ color: '#003A46' }}>
                                            <a href={`/events/${event.slug}`} 
                                               style={{ textDecoration: 'none', color: 'inherit' }}>
                                                {(locale === 'km' ? event.title_km : event.title_en)?.substring(0, 45)}
                                            </a>
                                        </h6>
                                        <div className="d-flex align-items-center text-muted small mb-2">
                                            <i className="bi bi-calendar me-2"></i> 
                                            {new Date(event.start_datetime).toLocaleDateString('en', { month: 'short', day: 'numeric', year: 'numeric' })}
                                        </div>
                                        <div className="d-flex align-items-center text-muted small mb-2">
                                            <i className="bi bi-geo-alt me-2"></i> {event.location}
                                        </div>
                                        <span style={{ 
                                            background: 'linear-gradient(135deg, #003A46, #00AACC)', 
                                            borderRadius: '20px', padding: '0.25rem 0.75rem',
                                            fontSize: '0.75rem', color: 'white' 
                                        }}>
                                            {event.type}
                                        </span>
                                    </div>
                                ))}
                                
                                <a href={window.Laravel?.routes?.events || '#'} 
                                   className="btn btn-outline-dark w-100 mt-3" style={{ borderRadius: '50px' }}>
                                    {t("View All Events", "មើលទាំងអស់")}
                                </a>
                            </div>
                            
                            <div className="p-4" style={{ 
                                background: 'linear-gradient(135deg, #003A46, #005f6b)', 
                                borderRadius: '20px', color: 'white' 
                            }}>
                                <h5 className="fw-bold mb-4">
                                    <i className="bi bi-link-45deg me-2"></i> {t("Quick Links", "តំណភ្ជាប់")}
                                </h5>
                                {[
                                    { icon: 'bi-mortarboard', text: t("Academic Programs", "កម្មវិធីសិក្សា"), link: window.Laravel?.routes?.programs },
                                    { icon: 'bi-newspaper', text: t("Articles", "អត្ថបទ"), link: window.Laravel?.routes?.articles },
                                    { icon: 'bi-people', text: t("Faculty", "បណ្ឌិត្យសភា"), link: window.Laravel?.routes?.faculty },
                                    { icon: 'bi-download', text: t("Downloads", "ទាញយក"), link: '#' },
                                    { icon: 'bi-envelope', text: t("Contact Us", "ទំនាក់ទំនង"), link: '#' },
                                ].map((link, i) => (
                                    <a key={i} href={link.link} 
                                       className="d-flex align-items-center p-2 rounded-3 mb-2"
                                       style={{ 
                                           color: 'rgba(255,255,255,0.8)', 
                                           textDecoration: 'none',
                                           transition: 'all 0.3s ease' 
                                       }}
                                       onMouseOver={(e) => {
                                           e.currentTarget.style.background = 'rgba(255,255,255,0.15)';
                                           e.currentTarget.style.color = 'white';
                                           e.currentTarget.style.transform = 'translateX(5px)';
                                       }}
                                       onMouseOut={(e) => {
                                           e.currentTarget.style.background = 'transparent';
                                           e.currentTarget.style.color = 'rgba(255,255,255,0.8)';
                                           e.currentTarget.style.transform = 'translateX(0)';
                                       }}>
                                        <i className={`${link.icon} me-2`}></i> {link.text}
                                    </a>
                                ))}
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section className="py-5" style={{ background: 'linear-gradient(180deg, #f8fafc 0%, #e2e8f0 100%)' }}>
                <div className="container">
                    <div className="text-center mb-5">
                        <span className="px-4 py-2 mb-3 d-inline-block" 
                              style={{ background: '#e0f2fe', color: '#0284c7', borderRadius: '50px', fontSize: '0.875rem' }}>
                            <i className="bi bi-mortarboard me-2"></i>{t("Academic Programs", "កម្មវិធីសិក្សា")}
                        </span>
                        <h2 style={{ color: '#003A46', fontWeight: 700, marginBottom: '0.5rem', fontSize: '2rem' }}>
                            {t("Explore Our Programs", "ស្វែងរកកម្មវិធីរបស់យើង")}
                        </h2>
                        <p className="text-muted" style={{ maxWidth: '600px', margin: '0 auto' }}>
                            {t("Comprehensive legal education programs designed to prepare you for a successful career in law",
                               "កម្មវិធីអប់រំផ្នែកច្បាប់សង្គមដែលត្រូវបានរៀបចំដើម្បីរៀបចំអ្នកសម្រាប់អាជីពជោគជ័យក្នុងវិស័យច្បាប់")}
                        </p>
                    </div>
                    
                    <div className="row g-4">
                        {[
                            { 
                                icon: 'bi-book-fill', 
                                title: t("Bachelor of Laws", "បរិញ្ញាប័ត្រផ្នែកច្បាប់"),
                                desc: t("Four-year comprehensive program covering civil law, criminal law, constitutional law, and more.",
                                        "កម្មវិធីបួនឆ្នាំសង្គមដែលគ្របដណ្តប់លើច្បាប់ស៊ីវិល ច្បាប់ពេទ្យច្បាប់ ច្បាប់រដ្ឋធម្មនុញ្ញ និងច្បាប់ផ្សេងៗទៀត"),
                                color: '#0284c7', bg: '#e0f2fe' 
                            },
                            { 
                                icon: 'bi-award-fill', 
                                title: t("Master of Laws", "បណ្ឌិត្យសភាផ្នែកច្បាប់"),
                                desc: t("Advanced two-year program with specialization options in international law, business law, and more.",
                                        "កម្មវិធីក្រោមបីឆ្នាំជាមួយជម្រើសឯកទេសក្នុងច្បាប់អន្តរជាតិ ច្បាប់អាជីព និងច្បាប់ផ្សេងៗទៀត"),
                                color: '#16a34a', bg: '#dcfce7' 
                            },
                            { 
                                icon: 'bi-mortarboard-fill', 
                                title: t("PhD in Law", " បណ្ឌិត្យសភាបីផ្នែកច្បាប់"),
                                desc: t("Doctoral program for advanced legal research and academic career development.",
                                        "កម្មវិធីបណ្ឌិត្យសភាសម្រាប់ការស្រាវជ្រាវផ្នែកច្បាប់ក្រោមកម្រិត និងការអភិវឌ្ឍអាជីព"),
                                color: '#d97706', bg: '#fef3c7' 
                            },
                        ].map((program, index) => (
                            <div className="col-md-4" key={index}>
                                <div style={styles.programCard}
                                     onMouseOver={(e) => {
                                         e.currentTarget.style.transform = 'translateY(-10px)';
                                         e.currentTarget.style.boxShadow = '0 25px 60px rgba(0,0,0,0.15)';
                                     }}
                                     onMouseOut={(e) => {
                                         e.currentTarget.style.transform = 'translateY(0)';
                                         e.currentTarget.style.boxShadow = '0 10px 40px rgba(0,0,0,0.08)';
                                     }}>
                                    <div style={{ 
                                        width: 100, height: 100, borderRadius: '50%', 
                                        display: 'flex', alignItems: 'center', justifyContent: 'center',
                                        margin: '0 auto 1.5rem', fontSize: '2.5rem',
                                        background: program.bg, color: program.color,
                                        transition: 'all 0.4s ease'
                                    }}>
                                        <i className={program.icon}></i>
                                    </div>
                                    <h5 className="fw-bold mb-3" style={{ color: '#003A46' }}>{program.title}</h5>
                                    <p className="text-muted mb-4">{program.desc}</p>
                                    <a href={window.Laravel?.routes?.programs || '#'}
                                       className="btn btn-outline-dark"
                                       style={{ borderRadius: '30px' }}>
                                        {t("Learn More", "ស្វែងយល់")} <i className="bi bi-arrow-right ms-2"></i>
                                    </a>
                                </div>
                            </div>
                        ))}
                    </div>
                </div>
            </section>

            <section style={styles.ctaModern}>
                <div style={{
                    position: 'absolute',
                    top: 0, left: 0, right: 0, bottom: 0,
                    backgroundImage: `
                        radial-gradient(circle at 20% 80%, rgba(0,170,204,0.3) 0%, transparent 50%),
                        radial-gradient(circle at 80% 20%, rgba(255,255,255,0.1) 0%, transparent 40%),
                        radial-gradient(circle at 40% 40%, rgba(0,170,204,0.2) 0%, transparent 30%)
                    `,
                    pointerEvents: 'none'
                }}></div>
                
                <div className="container" style={{ position: 'relative', zIndex: 1 }}>
                    <div className="row justify-content-center">
                        <div className="col-lg-10 text-center">
                            <div style={{
                                background: 'rgba(255,255,255,0.1)',
                                backdropFilter: 'blur(10px)',
                                border: '1px solid rgba(255,255,255,0.2)',
                                borderRadius: '24px',
                                padding: '3rem',
                            }}>
                                <h2 className="h1 fw-bold mb-4 text-white">
                                    {t("Ready to Start Your Journey?", "ត្រះត្រេះក្នុងការចាប់ផ្តើមដំណើររបស់អ្នក?")}
                                </h2>
                                <p className="lead text-white-70 mb-5" style={{ maxWidth: '600px', margin: '0 auto 2rem' }}>
                                    {t("Join Cambodia's premier law faculty and shape your future in legal profession",
                                       "ចូលរួមជាមួយស្ថាប័នច្បាប់លើកស្ទួយរបស់កម្ពុជា និងធ្វើឱ្យបច្ចុប្បន្នភាពអនាគតរបស់អ្នកក្នុងវិស័យច្បាប់")}
                                </p>
                                <a href={window.Laravel?.routes?.admission || '#'}
                                   style={{
                                       background: '#fff',
                                       color: '#003A46',
                                       border: 'none',
                                       padding: '1rem 2.5rem',
                                       borderRadius: '50px',
                                       fontWeight: 700,
                                       fontSize: '1.1rem',
                                       textDecoration: 'none',
                                       display: 'inline-flex',
                                       alignItems: 'center',
                                       gap: '0.5rem',
                                       transition: 'all 0.4s ease',
                                       boxShadow: '0 4px 15px rgba(0,0,0,0.2)'
                                   }}
                                   onMouseOver={(e) => {
                                       e.target.style.transform = 'translateY(-3px)';
                                       e.target.style.boxShadow = '0 8px 30px rgba(0,170,204,0.4)';
                                   }}
                                   onMouseOut={(e) => {
                                       e.target.style.transform = 'translateY(0)';
                                       e.target.style.boxShadow = '0 4px 15px rgba(0,0,0,0.2)';
                                   }}>
                                    <i className="bi bi-mortarboard-fill"></i>
                                    {t("Apply Now", " ដាក់ពាក្យ")}
                                    <i className="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </>
    );
};

export default ModernLanding;
