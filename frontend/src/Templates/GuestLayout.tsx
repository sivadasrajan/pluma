import React from 'react'; // importing FunctionComponent


const GuestLayout = ({children}: {children: React.ReactNode}) => {
  return <div className='p-2 flex justify-center w-full'>
      {children}
    </div>;
}

export default GuestLayout;