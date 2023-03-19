import { useCaseStore } from '@/stores/case';
import { customRef } from 'vue';

export function useValidateEmail(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
}

export async function useSaveSectionData(data, clientId) {
    let result = await axios
        .post(`/case-data`, data)
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

export function scrollToTop() {
    window.scrollTo(0, 0);
}

export function useSaveData(section, formData) {
    const store = useCaseStore();
    let data = {
        section,
        data: JSON.stringify(formData)
    };
    useSaveSectionData(data, store.activeCase).then((response) => {
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

export function useDebouncedRef(value, delay = 200) {
    let timeout;
    return customRef((track, trigger) => {
        return {
            get() {
                track();
                return value;
            },
            set(newValue) {
                clearTimeout(timeout);
                timeout = setTimeout(() => {
                    value = newValue;
                    trigger();
                }, delay);
            }
        };
    });
}
