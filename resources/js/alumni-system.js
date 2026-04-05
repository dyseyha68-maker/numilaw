/**
 * Alumni Management System JavaScript
 * Handles interactive features for alumni directory, job board, and events
 */

class AlumniSystem {
    constructor() {
        this.init();
    }

    init() {
        this.initTooltips();
        this.initModals();
        this.initFilters();
        this.initSearch();
        this.initConnections();
        this.initApplications();
        this.initLazyLoading();
    }

    /**
     * Initialize Bootstrap tooltips
     */
    initTooltips() {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    }

    /**
     * Initialize modals
     */
    initModals() {
        // Handle connection modal
        const connectModal = document.getElementById('connectModal');
        if (connectModal) {
            connectModal.addEventListener('show.bs.modal', (event) => {
                const button = event.relatedTarget;
                const alumniId = button.getAttribute('data-alumni-id');
                const alumniName = button.getAttribute('data-alumni-name');
                
                const form = document.getElementById('connectForm');
                const alumniNameSpan = document.getElementById('alumniName');
                
                if (form && alumniNameSpan) {
                    alumniNameSpan.textContent = alumniName;
                    form.action = form.action.replace(':alumni_id', alumniId);
                }
            });
        }

        // Handle job application modal
        const applyModal = document.getElementById('applyModal');
        if (applyModal) {
            applyModal.addEventListener('show.bs.modal', (event) => {
                const button = event.relatedTarget;
                const jobId = button.getAttribute('data-job-id');
                const jobTitle = button.getAttribute('data-job-title');
                
                const form = document.getElementById('applyForm');
                const jobTitleSpan = document.getElementById('jobTitle');
                
                if (form && jobTitleSpan) {
                    jobTitleSpan.textContent = jobTitle;
                    form.action = form.action.replace(':job_id', jobId);
                }
            });
        }
    }

    /**
     * Initialize filter forms
     */
    initFilters() {
        // Auto-submit filters on change (with debouncing)
        const filterForms = document.querySelectorAll('.filter-form');
        filterForms.forEach(form => {
            let timeout;
            const inputs = form.querySelectorAll('select, input');
            
            inputs.forEach(input => {
                input.addEventListener('change', () => {
                    clearTimeout(timeout);
                    timeout = setTimeout(() => {
                        form.submit();
                    }, 500);
                });
            });
        });
    }

    /**
     * Initialize search functionality
     */
    initSearch() {
        const searchInputs = document.querySelectorAll('.search-input');
        searchInputs.forEach(input => {
            let timeout;
            
            input.addEventListener('input', (e) => {
                clearTimeout(timeout);
                timeout = setTimeout(() => {
                    const query = e.target.value;
                    this.performSearch(query);
                }, 300);
            });
        });
    }

    /**
     * Perform AJAX search
     */
    performSearch(query) {
        if (query.length < 2) {
            this.clearSearchResults();
            return;
        }

        // Show loading spinner
        this.showSearchLoading();

        // Perform AJAX request (implement based on your backend)
        fetch(`/search?q=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(data => {
                this.displaySearchResults(data);
            })
            .catch(error => {
                console.error('Search error:', error);
                this.clearSearchResults();
            })
            .finally(() => {
                this.hideSearchLoading();
            });
    }

    /**
     * Display search results
     */
    displaySearchResults(results) {
        const resultsContainer = document.getElementById('searchResults');
        if (!resultsContainer) return;

        if (results.length === 0) {
            resultsContainer.innerHTML = '<div class="no-results">No results found</div>';
            return;
        }

        const resultsHTML = results.map(item => `
            <div class="search-result-item" data-url="${item.url}">
                <div class="search-result-content">
                    <h6>${item.title}</h6>
                    <p class="text-muted">${item.description}</p>
                </div>
            </div>
        `).join('');

        resultsContainer.innerHTML = resultsHTML;
        resultsContainer.style.display = 'block';
    }

    /**
     * Clear search results
     */
    clearSearchResults() {
        const resultsContainer = document.getElementById('searchResults');
        if (resultsContainer) {
            resultsContainer.innerHTML = '';
            resultsContainer.style.display = 'none';
        }
    }

    /**
     * Show search loading state
     */
    showSearchLoading() {
        const container = document.getElementById('searchResults');
        if (container) {
            container.innerHTML = '<div class="text-center py-3"><div class="spinner-border" role="status"></div></div>';
            container.style.display = 'block';
        }
    }

    /**
     * Hide search loading state
     */
    hideSearchLoading() {
        // Loading will be replaced by results or cleared
    }

    /**
     * Initialize connection features
     */
    initConnections() {
        // Handle connection request form submission
        const connectForms = document.querySelectorAll('.connect-form');
        connectForms.forEach(form => {
            form.addEventListener('submit', (e) => {
                e.preventDefault();
                this.submitConnectionRequest(form);
            });
        });

        // Handle connection response buttons
        const connectionButtons = document.querySelectorAll('.connection-action');
        connectionButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();
                this.handleConnectionAction(button);
            });
        });
    }

    /**
     * Submit connection request
     */
    submitConnectionRequest(form) {
        const formData = new FormData(form);
        const submitBtn = form.querySelector('button[type="submit"]');
        
        // Show loading state
        if (submitBtn) {
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Sending...';
        }

        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                this.showSuccessMessage(data.message);
                const modal = bootstrap.Modal.getInstance(form.closest('.modal'));
                if (modal) modal.hide();
                form.reset();
            } else {
                this.showErrorMessage(data.message || 'Failed to send connection request');
            }
        })
        .catch(error => {
            console.error('Connection error:', error);
            this.showErrorMessage('An error occurred. Please try again.');
        })
        .finally(() => {
            // Restore button state
            if (submitBtn) {
                submitBtn.disabled = false;
                submitBtn.innerHTML = 'Send Connection Request';
            }
        });
    }

    /**
     * Handle connection actions (accept/decline/withdraw)
     */
    handleConnectionAction(button) {
        const action = button.getAttribute('data-action');
        const connectionId = button.getAttribute('data-connection-id');
        const url = button.getAttribute('data-url');

        if (!confirm(`Are you sure you want to ${action} this connection request?`)) {
            return;
        }

        button.disabled = true;
        button.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Processing...';

        fetch(url, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                this.showSuccessMessage(data.message);
                location.reload();
            } else {
                this.showErrorMessage(data.message || 'Failed to process action');
            }
        })
        .catch(error => {
            console.error('Connection action error:', error);
            this.showErrorMessage('An error occurred. Please try again.');
        })
        .finally(() => {
            button.disabled = false;
            button.innerHTML = action.charAt(0).toUpperCase() + action.slice(1);
        });
    }

    /**
     * Initialize job application features
     */
    initApplications() {
        const applyForms = document.querySelectorAll('.apply-form');
        applyForms.forEach(form => {
            form.addEventListener('submit', (e) => {
                e.preventDefault();
                this.submitJobApplication(form);
            });
        });
    }

    /**
     * Submit job application
     */
    submitJobApplication(form) {
        const formData = new FormData(form);
        const submitBtn = form.querySelector('button[type="submit"]');
        
        // Show loading state
        if (submitBtn) {
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Applying...';
        }

        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                this.showSuccessMessage(data.message);
                const modal = bootstrap.Modal.getInstance(form.closest('.modal'));
                if (modal) modal.hide();
                form.reset();
                
                // Update application count if applicable
                const countElement = document.getElementById(`job-${data.jobId}-applications`);
                if (countElement) {
                    countElement.textContent = data.newCount;
                }
            } else {
                this.showErrorMessage(data.message || 'Failed to submit application');
            }
        })
        .catch(error => {
            console.error('Application error:', error);
            this.showErrorMessage('An error occurred. Please try again.');
        })
        .finally(() => {
            // Restore button state
            if (submitBtn) {
                submitBtn.disabled = false;
                submitBtn.innerHTML = 'Apply Now';
            }
        });
    }

    /**
     * Initialize lazy loading for images
     */
    initLazyLoading() {
        const images = document.querySelectorAll('img[data-src]');
        
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        img.removeAttribute('data-src');
                        observer.unobserve(img);
                    }
                });
            });

            images.forEach(img => imageObserver.observe(img));
        } else {
            // Fallback for older browsers
            images.forEach(img => {
                img.src = img.dataset.src;
            });
        }
    }

    /**
     * Show success message
     */
    showSuccessMessage(message) {
        this.showToast(message, 'success');
    }

    /**
     * Show error message
     */
    showErrorMessage(message) {
        this.showToast(message, 'danger');
    }

    /**
     * Show toast notification
     */
    showToast(message, type = 'info') {
        const toastContainer = document.getElementById('toastContainer');
        if (!toastContainer) return;

        const toastId = 'toast-' + Date.now();
        const toastHTML = `
            <div id="${toastId}" class="toast show align-items-center text-white bg-${type} border-0" role="alert">
                <div class="d-flex">
                    <div class="toast-body">
                        ${message}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>
            </div>
        `;

        toastContainer.insertAdjacentHTML('beforeend', toastHTML);

        // Auto-remove after 5 seconds
        setTimeout(() => {
            const toast = document.getElementById(toastId);
            if (toast) {
                toast.remove();
            }
        }, 5000);
    }

    /**
     * Format date relative to now
     */
    formatRelativeTime(dateString) {
        const date = new Date(dateString);
        const now = new Date();
        const diff = now - date;
        
        const seconds = Math.floor(diff / 1000);
        const minutes = Math.floor(seconds / 60);
        const hours = Math.floor(minutes / 60);
        const days = Math.floor(hours / 24);
        
        if (days > 7) {
            return date.toLocaleDateString();
        } else if (days > 0) {
            return `${days} day${days > 1 ? 's' : ''} ago`;
        } else if (hours > 0) {
            return `${hours} hour${hours > 1 ? 's' : ''} ago`;
        } else if (minutes > 0) {
            return `${minutes} minute${minutes > 1 ? 's' : ''} ago`;
        } else {
            return 'Just now';
        }
    }

    /**
     * Debounce function
     */
    debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    window.alumniSystem = new AlumniSystem();
});

// Export for module usage
if (typeof module !== 'undefined' && module.exports) {
    module.exports = AlumniSystem;
}