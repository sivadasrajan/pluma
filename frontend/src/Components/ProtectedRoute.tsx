import { FC } from 'react';
import { Navigate } from 'react-router-dom';

interface PropType {
    component: React.FC;
}

const ProtectedRoute: FC<PropType> = ({ component: Component }) => {
    const isAuthenticated  = false;

    if (isAuthenticated) return <Component />;
    return <Navigate to='/login' />;
};

export default ProtectedRoute;