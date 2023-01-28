import { useState } from 'react'
import reactLogo from './assets/react.svg'
import './App.css'
import LoginPage from './Pages/LoginPage';
import { BrowserRouter, Route, Routes } from 'react-router-dom';
import ProtectedRoute from './Components/ProtectedRoute';
import { LandingPage } from './Pages/LandingPage';
import { NotFoundPage } from './Pages/NotFoundPage';
import HomePage from './Pages/Authenticated/HomePage';

function App() {
  const [count, setCount] = useState(0)


  return (
    <div>

      <BrowserRouter>
        <Routes>
            <Route path='/' element={<LandingPage />} />
            <Route path='/login' element={<LoginPage />} />
            <Route path='/home' element={<ProtectedRoute component={HomePage} />} />
            <Route path='*' element={<NotFoundPage />} />
        </Routes>
      </BrowserRouter>
    </div>
  )
}

export default App
