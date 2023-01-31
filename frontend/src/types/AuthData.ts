import APIRespose from "./APIRespose";

export interface AuthData extends APIRespose {
    data:{
        name:string,
        access_token:string
    },
}

export interface AuthContextData {
    signed: boolean;
    user: object | null;
    loading: boolean;
    Login: (email:string,password:string) => Promise<AuthData>;
    Logout: () => void;
  }
