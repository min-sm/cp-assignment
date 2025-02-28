export default function initAlpine() {
    window.data = function () {
        return {
            dark: localStorage.getItem('dark') === 'true',
            toggleTheme() {
                this.dark = !this.dark;
                localStorage.setItem('dark', this.dark);

                // Toggle the 'dark' class on the html element
                if (this.dark) {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                }
            },
            isSideMenuOpen: false,
            toggleSideMenu() {
                this.isSideMenuOpen = !this.isSideMenuOpen;
            },
            closeSideMenu() {
                this.isSideMenuOpen = false;
            },
            isNotificationsMenuOpen: false,
            toggleNotificationsMenu() {
                this.isNotificationsMenuOpen = !this.isNotificationsMenuOpen;
            },
            closeNotificationsMenu() {
                this.isNotificationsMenuOpen = false;
            },
            isProfileMenuOpen: false,
            toggleProfileMenu() {
                this.isProfileMenuOpen = !this.isProfileMenuOpen;
            },
            closeProfileMenu() {
                this.isProfileMenuOpen = false;
            },
            isPagesMenuOpen: false,
            togglePagesMenu() {
                this.isPagesMenuOpen = !this.isPagesMenuOpen;
            },
            // Modal
            isModalOpen: false,
            trapCleanup: null,
            openModal() {
                this.isModalOpen = true;
                this.trapCleanup = focusTrap(document.querySelector("#modal"));
            },
            closeModal() {
                this.isModalOpen = false;
                this.trapCleanup();
            },
        };
    }
}
