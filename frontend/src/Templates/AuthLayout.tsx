import React from 'react'; // importing FunctionComponent
import Header from './Auth/Header';


const AuthLayout = ({children}: {children: React.ReactNode}) => {
  return <div>
    <Header ></Header>
      <div className='p-2'>
        {children}
        </div>
      </div>;
  }
  

export default AuthLayout;