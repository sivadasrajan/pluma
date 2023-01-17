import React from 'react'; // importing FunctionComponent
import GuestLayout from '../Templates/GuestLayout';


const LoginPage: React.FC = () => {
  return <GuestLayout>
    <div className="card w-full bg-neutral text-neutral-content">
      <div className="card-body items-center text-center">
        <h2 className="card-title">Login</h2>
        <div>
          <div className="form-control w-full max-w-xs">
            <label className="label">
              <span className="label-text">What is your name?</span>
              <span className="label-text-alt">Alt label</span>
            </label>
            <input type="text" placeholder="Type here" className="input input-bordered w-full max-w-xs" />
            <label className="label">
              <span className="label-text-alt">Alt label</span>
              <span className="label-text-alt">Alt label</span>
            </label>
          </div>
        </div>
        <div className="card-actions justify-end">
          <button className="btn btn-primary">Accept</button>
          <button className="btn btn-ghost">Deny</button>
        </div>
      </div>
    </div>
  </GuestLayout>;
}

export default LoginPage;