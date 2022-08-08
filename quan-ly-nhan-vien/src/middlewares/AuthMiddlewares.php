<?php
    class AuthMiddlewares {
        public function isManager() {
            $role = $_SESSION['role'];
            return $role == "Manager";
        }

        public function isCEO() {
            $role = $_SESSION['role'];
            return $role == "CEO";
        }

        public function isEmployee() {
            $role = $_SESSION['role'];
            return $role == "Employee";
        }
    }