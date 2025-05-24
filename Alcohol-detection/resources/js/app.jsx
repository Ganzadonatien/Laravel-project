import React from 'react';
import '../css/app.css';

import { createRoot } from 'react-dom/client';
import AlcoholChart from './components/AlcoholChart';

const chartDiv = document.getElementById('chart');
if (chartDiv) {
    const root = createRoot(chartDiv);
    root.render(<AlcoholChart />);
}
