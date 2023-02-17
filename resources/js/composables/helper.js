import { useClientStore } from '@/stores/client.js';

export function useValidateEmail(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
}

export async function useSaveSectionData(data, clientId) {
    let result;
    await axios
        .patch(`/clients/${clientId}`, data)
        .then((response) => {
            result = [true, response];
        })
        .catch((response) => {
            result = [false, response];
        });
    return result;
}
export function useFlashLabel() {
    let label = $('.flashit');
    label.css('background-color', '#FB952C');
    setTimeout(() => {
        label.css('transition', 'all .9s');
        label.css('background-color', 'transparent');
    }, 100);
}

export function useSaveData(section, formData) {
    const store = useClientStore();
    let data = {};
    data[section] = JSON.stringify(formData);
    useSaveSectionData(data, store.client.id).then((response) => {
        if (response[0]) {
            console.log(response);
            store.updateClient(response[1].data);
        }
    });
}
export function randomString(length = 7) {
    const possibleChars =
        'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    let text = '';

    for (let i = 0; i < length; i++)
        text += possibleChars.charAt(
            Math.floor(Math.random() * possibleChars.length)
        );

    return text;
}
