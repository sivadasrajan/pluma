import React from 'react'; // importing FunctionComponent
import GuestLayout from '../Templates/GuestLayout';


const LoginPage: React.FC = () => {
  return <GuestLayout>
    <div className="card bg-neutral text-neutral-content">
      <div className="card-body items-center text-center">
        <h2 className="card-title">Login</h2>
        <div>
          <div className="form-control w-full max-w-xs">
            <label className="label">
              <span className="label-text">Username</span>
            </label>
            <input type="text" placeholder="Enter Username" className="input input-bordered w-full max-w-xs" />
          </div>
        </div>
        <div>
          <div className="form-control w-full max-w-xs">
            <label className="label">
              <span className="label-text">Password</span>
            </label>
            <input type="text" placeholder="Enter Password" className="input input-bordered w-full max-w-xs" />
          </div>
        </div>
        <div className="card-actions justify-between w-full">
          <button className="btn w-full btn-primary">Login</button>
        </div>
      </div>
    </div>
  </GuestLayout>;
}

export default LoginPage;