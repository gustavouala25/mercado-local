<div x-data="{ 
    deferredPrompt: null,
    showInstallPrompt: false,
    init() {
        window.addEventListener('beforeinstallprompt', (e) => {
            e.preventDefault();
            this.deferredPrompt = e;
            this.showInstallPrompt = true;
        });
    },
    install() {
        if (this.deferredPrompt) {
            this.deferredPrompt.prompt();
            this.deferredPrompt.userChoice.then((choiceResult) => {
                if (choiceResult.outcome === 'accepted') {
                    console.log('User accepted the install prompt');
                } else {
                    console.log('User dismissed the install prompt');
                }
                this.deferredPrompt = null;
                this.showInstallPrompt = false;
            });
        }
    }
}" 
x-show="showInstallPrompt" 
x-transition:enter="transition ease-out duration-300"
x-transition:enter-start="opacity-0 transform translate-y-4"
x-transition:enter-end="opacity-100 transform translate-y-0"
x-transition:leave="transition ease-in duration-200"
x-transition:leave-start="opacity-100 transform translate-y-0"
x-transition:leave-end="opacity-0 transform translate-y-4"
class="fixed bottom-4 left-1/2 transform -translate-x-1/2 z-50" 
style="display: none;">
    <button @click="install()" class="bg-gradient-to-r from-orange-500 to-red-500 text-white font-bold py-3 px-6 rounded-full shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 flex items-center gap-2">
        <span class="text-xl">📲</span>
        <span>Instalar App</span>
    </button>
</div>
