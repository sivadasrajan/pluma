import React from 'react'; // importing FunctionComponent


const GuestLayout = ({children}: {children: React.ReactNode}) => {
  return <div className='w-full'>
      {children}
    </div>;
}

export default GuestLayout;