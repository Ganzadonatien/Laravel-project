import './bootstrap';
import React from 'react';
import { createRoot } from 'react-dom/client';
import AlcoholChart from './components/AlcoholChart';

const chartDiv = document.getElementById('alcohol-chart');
if (chartDiv) {
    const root = createRoot(chartDiv);
    root.render(<AlcoholChart />);
}
