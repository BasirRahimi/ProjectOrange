export function useValidateEmail(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
}

export async function useSaveSectionData(data, clientId) {
    let result;
    await axios.patch(`/clients/${clientId}`, data).then(response => {
        result = [true, response];
    }).catch(response => {
        result = [false, response];
    })
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
export function useRouterPush(section) {
    this.$router.push({ name: section });
}
export function useSaveData() {
    let data = {};
    data[this.section] = JSON.stringify(this.formData);
    this.saveSectionData(data, this.$store.state.client.id).then(response => {
        if (response[0]) {
            console.log(response)
            this.$store.commit('updateClient', response[1].data);
        }
    });
}