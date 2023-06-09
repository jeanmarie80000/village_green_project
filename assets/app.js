import { registerReactControllerComponents } from '@symfony/ux-react';
import { StrictMode } from 'react';
import { createRoot } from 'react-dom/client'
import React from 'react';
import ReactDOM from 'react';

import './bootstrap.js';
import './styles/app.css';
import ProductList from './react/data/dataProduct.jsx';

// registerReactControllerComponents(require.context('./react/controllers', true, /\.(j|t)sx?$/));

const rootElement = document.getElementById('root');
const root = createRoot(rootElement);

root.render(
    <React.StrictMode>
        <ProductList />
    </React.StrictMode>
)