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
    
      const res = await api.post<AuthData,AuthData>("/api/v1/login", {
        'username': email,
        'password': password,
      });

      // const userData = await api.get<{}>("/auth/user");
      setUser({name:'blah'});
      console.log(!!user);
      console.log(res);
      
      localStorage.setItem("@Auth:access_token", res.content.access_token);
      localStorage.setItem("@Auth:user", JSON.stringify('user'));
      
      return res;
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