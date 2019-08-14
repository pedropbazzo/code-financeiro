<?php

namespace CodeFinance\Listeners;

use CodeFinance\Events\BankStoredEvent;
use CodeFinance\Repositories\BankRepository;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class BankLogoUploadListener
{
    /**
     * @var BankRepository
     */
    private $repository;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(BankRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Handle the event.
     *
     * @param  BankStoredEvent  $event
     * @return void
     */
    public function handle(BankStoredEvent $event)
    {
        // Lógica de upload do arquivo
        $bank = $event->getBank();
        $logo = $event->getLogo();

        if($logo) {
            // Cria o nome do arquivo com o time atual em md5 e concatena com a extensão do arquivo
            // Realiza um ternário para ver se a data de atualização é diferente da data de criação
            $name = $bank->created_at != $bank->updated_at ? $bank->logo : md5(time()) . '.' . $logo->guessExtension();

            // Destino de onde ficara as imagens
            $destFile = $bank->logosDir() ;

            // Configura o disco que será gravado
            // Se eu não configurar ele vai pegar o padrão que está configurada no system files
            // Depois faz o upload usando putFileAs passando os parametros DESTINO, ARQUIVO, NOME_DO_ARQUIVO
            \Storage::disk('public')->putFileAs($destFile, $logo, $name);

                if($bank->created_at == $bank->updated_at) {
                    // Chama o repositorio de bank e faz uma atualização da logo
                    $this->repository->update(['logo' => $name], $bank->id);
                }
        }

    }
}
