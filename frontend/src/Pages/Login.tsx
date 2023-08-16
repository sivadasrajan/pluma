import React, { useState } from 'react'; // importing FunctionComponent
import GuestLayout from '../Templates/GuestLayout';
import { useAuth } from "../hooks/Auth";
import { redirect, useNavigate } from 'react-router-dom';
import { TextInput } from '../Components/Input/TextInput';
import { AuthData } from '../types/AuthData';


const Login: React.FC = () => {


  const INITIAL_LOGIN_OBJ = {
    password: "",
    emailId: ""
  }
  const [loading, setLoading] = useState(false)
  const [message, setMessage] = useState('');
  const [loginObj, setLoginObj] = useState(INITIAL_LOGIN_OBJ)

  const { Login } = useAuth();
  let navigate = useNavigate();

  const handleLogin = () => {
    setLoading(true)

    Login(loginObj.emailId, loginObj.password).then((response) => {
      
      if (response.data){
        console.log("EEEEEe");
        
        navigate('/home');
      }
      else
        setMessage(response.message!!)

      setLoading(false)

    }).catch((e) => {
      console.log(e);
      setLoading(false)

      setMessage('Something went wrong');
    });
  }

  const updateFormValue = (updateType: string, value: string) => {
    setMessage("")
    setLoginObj({ ...loginObj, [updateType]: value })
  }
  return <GuestLayout>

<div className="card mx-auto w-full shadow p-2 max-w-sm">
        <div className="grid  grid-cols-1  bg-base-100 rounded-xl">
          
          <div className='py-24 px-10'>
            <h2 className='text-2xl font-semibold mb-2 text-center'>Login</h2>


            <div className="mb-4">

              <TextInput type="emailId" defaultValue={loginObj.emailId} updateType="emailId" containerStyle="mt-4" labelTitle="Email Id" updateFormValue={updateFormValue} />

              <TextInput defaultValue={loginObj.password} type="password" updateType="password" containerStyle="mt-4" labelTitle="Password" updateFormValue={updateFormValue} />

            </div>

            
            </div>

            <div className="mt-8">{message}</div>
            <button type="submit" className={"btn mt-2 w-full btn-primary" + (loading ? " loading" : "")} onClick={handleLogin}>Login</button>

            

          </div>
        </div>
  </GuestLayout>;
}

export default Login;
