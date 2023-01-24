import { BrowserRouter, Sw, Route } from "react-router-dom";
function Routes() {
  return (

    <BrowserRouter>
      <Routes>
        <Route path="/" element={< LoginPage />}>
          {/* <Route index element={<Home />} />
          <Route path="blogs" element={<Blogs />} />
          <Route path="contact" element={<Contact />} />
          <Route path="*" element={<NoPage />} /> */}
        </Route>
      </Routes>
    </BrowserRouter>
  )
}