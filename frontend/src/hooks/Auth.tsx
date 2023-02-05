import { AxiosResponse } from "axios";
import { createContext, useContext, useEffect, useState } from "react";

import api  from "../services/api";
import { AuthContextData, AuthData } from "../types/AuthData";



const AuthContext = createContext<AuthContextData>({} as AuthContextData);

export const AuthProvider = ({ children }: any) => {
  const [user, setUser] = useState<object | null>(null);
  const [loading, setLoading] = useState<boolean>(true);

  useEffect(() => {
    async function loadStorageData() {
      const storageUser = localStorage.getItem("@Auth:user");
      const storageToken = localStorage.getItem("@Auth:access_token");

      if (storageUser && storageToken) {
        setUser(JSON.parse(storageUser));
      }
      setLoading(false);
    }

    loadStorageData();
  }, []);

  const Login = async (email:string,password:string) => {
    
      const res = await api.post<any,AxiosResponse<AuthData>>("/api/v1/login", {
        'username': email,
        'password': password,
      });

      // const userData = await api.get<{}>("/auth/user");
      if(res.data.success){
        setUser({name:res.data.data.name});       
        localStorage.setItem("@Auth:access_token", res.data.data.access_token);
        localStorage.setItem("@Auth:user", JSON.stringify('user'));
      }
      
      return res.data;
  };

  const Logout = () => {
    localStorage.clear(); 
    setUser(null);
  };

  return (
    <AuthContext.Provider
      value={{ signed: !!user, user, loading, Login, Logout }}
    >
      {children}
    </AuthContext.Provider>
  );
};

export const useAuth = () => {
  return useContext(AuthContext);
};