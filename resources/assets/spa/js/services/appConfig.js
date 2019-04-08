import config from '../config';

const location = window.location;

let localConfig = {
    host: `${location.protocol}//${location.hostname}:${location.port}`,
    
    /**
     * Quando poem get nomeDoMetodo(), ela não vai gerar apenas um método
     * vai gerar uma propriedade, sempre que acessarmos a propriedade, o método vai ser disparado     
     */
    get login_url() {
        return `${this.host}${config.app_path}${config.login_path}`;
    }
};

const appConfig = Object.assign({   
}, config, localConfig);

export default appConfig;