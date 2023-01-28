import { FC, useContext } from 'react';
import { Navigate } from 'react-router-dom';
import { useAuth } from '../hooks/Auth';

interface PropType {
    component: React.FC;
}

const ProtectedRoute: FC<PropType> = ({ component: Component }) => {
    const {signed}  = useAuth();
    console.log(signed);
    
    if (signed) return <Component />;
    return <Navigate to='/login' />;
};

export default ProtectedRoute;