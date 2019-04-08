import { Jwt } from "./resources";
import LocalStorage from './localStorage';

const TOKEN = 'token';

// #### Criando encapsulamento #### //

export default {

    get token() {
        return LocalStorage.get(TOKEN);
    },

    /**
     * Se tiver valor então setamos um valor para o token
     * caso seja null então destroi o token
     */
    set token(value) {
        return value ? LocalStorage.set(TOKEN, value) : LocalStorage.remove(TOKEN);
    },

    /**
     * Envia a requisição e guarda o token no localstorage
     * @param {*} email 
     * @param {*} password 
     */
    accessToken(email, password) {
        return Jwt.accessToken(email, password)
            .then((response) => {
                this.token = response.data.token;
                return response;
            });
    },

      /**
     * Realiza o refresh token
     * Se recebermos um novo token, então atribuimos o novo token
     */
    refreshToken() {
        return Jwt.refreshToken()
            .then((response) => {
                this.token = response.data.token;
                return response;
            });
    },

    revokeToken() {
        let afterRevokeToken = () => {
            this.token = null;
        };
        return Jwt.Logout()
            .then(afterRevokeToken())
            .catch(afterRevokeToken());
    },
    
    /**
     * retorna o token do usuário
     */
    getAuthorizationHeader() {
        return `Bearer ${LocalStorage.get(TOKEN)}`;
    },
}