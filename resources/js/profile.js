import React from "react";
import { createRoot } from "react-dom/client";
import { HashRouter, Routes, Route } from "react-router-dom";
import Cart from "./Profile/Cart";
import Nav from "./Profile/Component/Nav";
import Order from "./Profile/Order";
import Profile from "./Profile/ProfilePage/Profile";
import ChangePassword from './Profile/ChangePassword';

const MainRouter = () => {
    return (
        <HashRouter>
            <Nav/>
            <Routes>
                <Route path="/" element={<Profile />} />
                <Route path="/cart" element={<Cart />} />
                <Route path="/order" element={<Order />} />
                <Route path="/change-password" element={<ChangePassword />} />
            </Routes>
        </HashRouter>
    )
}

createRoot(document.getElementById("root")).render(<MainRouter />);
