import { useState } from 'react'
import reactLogo from './assets/react.svg'
import './App.css'
import LoginPage from './Pages/LoginPage';
import { BrowserRouter, Route, Routes } from 'react-router-dom';

function App() {
  const [count, setCount] = useState(0)

 
  return (
    <div>

    <BrowserRouter>
      <Routes>
        <Route path="/login" element={<LoginPage />}>
        </Route>
      </Routes>
      <Routes>
        <Route path="/slogin" element={<LoginPage />}>
        </Route>
      </Routes>
      404 error
    </BrowserRouter>
    </div>
  )
}

export default App
