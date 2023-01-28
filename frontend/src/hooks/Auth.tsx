import { createContext, useContext, useEffect, useState } from "react";

import api  from "../services/api";

export type LoginType = {
    email: string;
    password: string;
  };
  
  export interface AuthContextData {
    signed: boolean;
    user: object | null;
    loading: boolean;
    Login: ({}: LoginType) => Promise<void>;
    Logout: () => void;
  }


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

  const Login = async ({ email, password }: LoginType) => {
    
      const res = await api.post<{ access_token: string }>("/api/v1/login", {
        'username': 'yes',
        'password': 'bla',
      });

      // const userData = await api.get<{}>("/auth/user");
      setUser({name:'blah'});
      console.log(!!user);
      
      localStorage.setItem("@Auth:access_token", res.data.access_token);
      localStorage.setItem("@Auth:user", JSON.stringify('user'));
    
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