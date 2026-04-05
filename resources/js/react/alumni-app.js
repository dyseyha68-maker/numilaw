import React from 'react';
import { createRoot } from 'react-dom/client';
import AlumniDirectory from './components/AlumniDirectory';

// Alumni App entry point
const container = document.getElementById('alumni-directory-app');
if (container) {
    const root = createRoot(container);
    root.render(React.createElement(AlumniDirectory));
}

export default AlumniDirectory;