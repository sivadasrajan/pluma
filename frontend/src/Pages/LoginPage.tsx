import React, { useState } from 'react'; // importing FunctionComponent
import GuestLayout from '../Templates/GuestLayout';
import { LoginType, useAuth } from "../hooks/Auth";
import { redirect } from 'react-router-dom';


const LoginPage: React.FC = () => {


  const [email, setCnpj] = useState('');
    const [password, setPassword] = useState('');
    const [message, setMessage] = useState('');
    const { Login } = useAuth();


    const handleLogin = () => {
        Login({ email, password }).then(()=>{
          console.log("Redirecting");
          
          return redirect('https://www.google.com');
        }).catch(()=>{
          setMessage('NEtowrk error');
        });
    }

  return <GuestLayout>
    <div className="card bg-neutral text-neutral-content">
      <div className="card-body items-center text-center">
        <h2 className="card-title">Login</h2>
        <div>
          <div className="form-control w-full max-w-xs">
            <label className="label">
              <span className="label-text">Username</span>
            </label>
            <input type="text" placeholder="Enter Username" className="input input-bordered w-full max-w-xs" onChange={e => setCnpj(e.target.value)} />
          </div>
        </div>
        <div>
          <div className="form-control w-full max-w-xs">
            <label className="label">
              <span className="label-text">Password</span>
            </label>
            <input type="text" placeholder="Enter Password" className="input input-bordered w-full max-w-xs"  onChange={e => setPassword(e.target.value)}/>
          </div>
        </div>
        <div>{message}</div>
        <div className="card-actions justify-between w-full">
          <button className="btn w-full btn-primary" onClick={handleLogin}>Login</button>
        </div>
      </div>
    </div>
  </GuestLayout>;
}

export default LoginPage;
