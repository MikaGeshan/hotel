import React from "react";
import { usePage } from "@inertiajs/react";
import AdminHeader from "../../Layouts/AdminHeader";
import AdminSidebar from "../../Layouts/AdminSidebar";

export default function Dashboard() {
    const { auth } = usePage().props;

    return (
        <div className="min-h-screen bg-gray-100 flex flex-col">
            <AdminHeader user={auth.user} />
            <div className="flex flex-1">
                <AdminSidebar />
                <main className="flex-1 p-8 ml-64">
                    <div className="container mx-auto">
                        <h1 className="text-2xl font-semibold text-gray-800">
                            Dashboard
                        </h1>
                    </div>
                </main>
            </div>
        </div>
    );
}
