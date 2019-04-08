export class Jwt {

    /**
     * Realiza a requisição para o login
     * @param {*} email 
     * @param {*} password 
     */
    static accessToken(email, password) {
        return Vue.http.post('access_token', {
            email: email,
            password: password
        });
    }

    /**
     * Realiza a requisição para o logou
     */
    static Logout() {
        return Vue.http.post('logout');
    }

    /**
     * Realiza a requisição para recuperar o refresh token
     */
    static refreshToken() {
        return Vue.http.post('refresh_token');
    }
}

let User = Vue.resource('user');

export { User };