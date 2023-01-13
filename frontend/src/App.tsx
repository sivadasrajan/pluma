import { useState } from 'react'
import { BrowserRouter, Routes, Route } from "react-router-dom";
import reactLogo from './assets/react.svg'
import './App.css'
import Login from './Pages/Login';

function App() {
  const [count, setCount] = useState(0)

  return (
    <div>

    <BrowserRouter>
      <Routes>
        <Route path="/login" element={<Login />}>
          {/* <Route index element={<Home />} />
          <Route path="blogs" element={<Blogs />} />
          <Route path="contact" element={<Contact />} />
          <Route path="*" element={<NoPage />} /> */}
        </Route>
      </Routes>
    </BrowserRouter>
    404 error
    </div>
    
  )
}

export default App
