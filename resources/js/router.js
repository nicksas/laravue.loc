import {createRouter, createWebHistory} from "vue-router";
import About from "./pages/About";
import Main from "./pages/Main";
import UpdatePost from "./pages/UpdatePost";
import ExampleComponent from "./components/ExampleComponent";

const routes = [
    {
        path: '/',
        component: Main
    },
    {
        path: '/about',
        component: About
    },
    {
        path: '/posts/:id',
        component: UpdatePost
    },
    {
        path: '/posts/',
        component: ExampleComponent
    }
]
const router = createRouter({
    history: createWebHistory(),
    routes
})
export default router
