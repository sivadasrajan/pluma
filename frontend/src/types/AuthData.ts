import APIRespose from "./APIRespose";

export interface AuthData extends APIRespose {
    data:{
        name:string,
        token:string
    },
}


export type LoginType = {
    email: string;
    password: string;
  };
  
export interface AuthContextData {
    signed: boolean;
    user: object | null;
    loading: boolean;
    Login: ({}: LoginType) => Promise<AuthData>;
    Logout: () => void;
  }
