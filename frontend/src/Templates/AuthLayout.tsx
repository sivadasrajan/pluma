import { FC, ReactNode } from "react";
import Header from './Auth/Header';


interface IAuthLayoutProps {
  children:ReactNode
  title:string
 };

export const AuthLayout: FC<IAuthLayoutProps> = (props) => {
  return <div>
    <Header title={props.title}></Header>
    <div className='p-2'>
      {props.children}
    </div>
  </div>;
}



export default AuthLayout;