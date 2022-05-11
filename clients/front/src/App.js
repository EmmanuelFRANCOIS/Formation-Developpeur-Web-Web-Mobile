import React from 'react';
import { BrowserRouter, Routes, Route } from 'react-router-dom';
import Home from './pages/Home';
import Test from './pages/Test';
import PageClient from './pages/PageClient';

function App() {
  return (
    <BrowserRouter>
      <Routes>
        <Route path="/" element={<Home />} />
        <Route path="/test" element={<Test />} />
        <Route path="*" element={<Home />} /> 
        <Route path="/clients/:id" name="PageClient" element={<PageClient />} />
      </Routes>
    </BrowserRouter>
  );
}

export default App;
