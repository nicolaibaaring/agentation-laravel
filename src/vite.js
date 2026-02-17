import react from '@vitejs/plugin-react';

export default function agentation(entryPath = 'resources/vendor/agentation-laravel/agentation.js') {
    return {
        name: 'agentation-laravel',
        config(_, { mode }) {
            if (mode !== 'development') return;

            return {
                build: {
                    rollupOptions: {
                        input: [entryPath],
                    },
                },
                plugins: [react()],
            };
        },
    };
}
