import React from 'react'; // importing FunctionComponent
import AuthLayout from '../../Templates/AuthLayout';


const HomePage: React.FC = () => {
  return <AuthLayout>
    
        <div className="flex w-full h-full text-center text-3xl"> 
            Welcome Home
        </div>
    
  </AuthLayout>;
}

export default HomePage;