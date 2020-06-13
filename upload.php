<?php
class Upload{
	public $ficheiro,$pasta;
	private $formatos,$tipos_permitidos;

	public function operacao(){

        # cycle through the array
		for ($i=0; $i < count($this->ficheiro) ; $i++) { 

            # types of extensions allowed
            $this->tipos_permitidos = array('png','jpg','svg','jpeg');
            
            # get the file extension
            $this->formatos = strtolower(pathinfo($this->ficheiro[$i]['name'], PATHINFO_EXTENSION));
            
            # check if the extension file exists in the array
			if(in_array($this->formatos, $this->tipos_permitidos)){
                if(!is_dir($this->pasta)){
                    mkdir($this->pasta);
                }
                /* 
                 * moves the file, performs the upload
                 */
                $mover_ficheiro = move_uploaded_file($this->ficheiro[$i]['tmp_name'], $this->pasta.DIRECTORY_SEPARATOR.$this->ficheiro[$i]['name']);

                /*
                * checks if the upload was successful
                */
                if($mover_ficheiro){
                    echo "Upload Realizado Com Sucesso<br>";
                } else {
                    echo "Upload Not Realizado<br>";
                }

                /* 
                 *result if the file extension does not exist in the array
                 */
            } else {
                echo "Formato Não Permetido";
            } 
		}

	}
}
$uplaod = new Upload();
$uplaod->pasta='upload';
$uplaod->ficheiro =array($_FILES['arquivo1'],$_FILES['arquivo2'],$_FILES['arquivo3']);
$uplaod->operacao();