import { BrowserRouter,  Route, createBrowserRouter, createRoutesFromElements, RouterProvider } from "react-router-dom";
import LoginPage from "./Pages/LoginPage";
function Routes() {

  const router = createBrowserRouter(
    createRoutesFromElements(
      <Route path="/" element={<LoginPage />}>
                <Route path="/" element={< LoginPage />}/>
      </Route>
    )
  );
  return (

    <BrowserRouter>
      <RouterProvider router={router} />
    </BrowserRouter>
  )
}