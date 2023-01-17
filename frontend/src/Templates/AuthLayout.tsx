import React from 'react'; // importing FunctionComponent


const AuthLayout = ({children}: {children: React.ReactNode}) => {
    return <div>
        {children}
      </div>;
  }
  

export default AuthLayout;