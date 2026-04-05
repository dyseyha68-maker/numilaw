import React from 'react';
import { createRoot } from 'react-dom/client';
import ModernLanding from './components/ModernLanding.jsx';

const container = document.getElementById('react-landing-root');

if (container) {
    const root = createRoot(container);
    root.render(<ModernLanding />);
}
