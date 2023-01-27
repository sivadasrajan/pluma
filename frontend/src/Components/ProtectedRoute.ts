import React, { Component, ComponentProps } from 'react';
import auth from '../services/authService' // here i am checking local storage user is login 
import {
  Route,
  Navigate,
} from "react-router-dom";

type ProtectedRouteProps = {
  path: string,
  component: Component,
  render,
   ...rest
};
class ProtectedRoute extends Component<ProtectedRouteProps> {
  render() {
    const { path: string, component: Component, render, ...rest } = this.props
    return (

      <Route
        path= { path }
    {...rest }
    render = { props => {
      if (!auth.getCuurentUser()) return <Navigate to={
        {
          pathname: '/login',
            state: { from: props.location }
        }
      } />
      return Component ? <Component { ...props } /> : render(props);
    }
  }
        
        />
    );
  }
}

export default ProtectedRoute;