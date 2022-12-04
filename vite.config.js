import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import fs from 'fs';

function getFiles(path){
    return fs.readdirSync(path, {withFileTypes: true})
    .filter(item => !item.isDirectory())
    .map(item => path+"/"+item.name)
}

export default defineConfig({
    plugins: [
        laravel({
            input: 
            [
                ...getFiles('resources/css'),
                ...getFiles('resources/js')
            ],
            refresh: true,
        }),
    ],
});
