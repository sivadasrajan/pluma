import { useState } from 'react'
import './App.css'
import Login from './Pages/Login';
import { Route, Routes } from 'react-router-dom';
import ProtectedRoute from './Components/ProtectedRoute';
import { LandingPage } from './Pages/LandingPage';
import { NotFound } from './Pages/NotFound';
import HomePage from './Pages/Authenticated/HomePage';

function App() {
  const [count, setCount] = useState(0)


  return (
    <div>
        <Routes>
            <Route path='/' element={<LandingPage />} />
            <Route path='/login' element={<Login />} />
            <Route path='/home' element={<ProtectedRoute component={HomePage} />} />
            <Route path='*' element={<NotFound />} />
        </Routes>
    </div>
  )
}

export default App
