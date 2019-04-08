import Auth from './auth';
import appConfig from './appConfig';
import JwtToken from './jwt-token';

Vue.http.interceptors.push((request, next) => {
    request.headers.set('Authorization', JwtToken.getAuthorizationHeader());
    next();
});

/**
 * Configuração de refresh token da aplicação
 */
Vue.http.interceptors.push((request, next) => {
    next((response) => {                 
        if(response.status === 401) {  // 401 - Token expirado
            return JwtToken.refreshToken()
                .then(() => {
                    return Vue.http(request);
                })
                .catch(() => {
                    Auth.clearAuth();
                    window.location.href = appConfig.login_url;
                })
        }
    });
});