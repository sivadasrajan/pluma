import { useState } from 'react'
import { BrowserRouter, Routes, Route } from "react-router-dom";
import reactLogo from './assets/react.svg'
import './App.css'
import LoginPage from './Pages/LoginPage';

function App() {
  const [count, setCount] = useState(0)

  return (
   
    <BrowserRouter>
      <Routes>
        <Route path="/" element={<LoginPage />}>
          {/* <Route index element={<Home />} />
          <Route path="blogs" element={<Blogs />} />
          <Route path="contact" element={<Contact />} />
          <Route path="*" element={<NoPage />} /> */}
        </Route>
      </Routes>
    </BrowserRouter> 
  )
}

export default App
