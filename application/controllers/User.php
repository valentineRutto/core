<?php
    class User extends Languages {
        
        private $_ArborescenceDossier = array();
        private $_SizeTotal;
		private $_SizeTotalOctet;
        private $_CheminUser;
       	private $_Size;
       	
       	function getLastModification($chemin) {
       		$lstat = lstat($chemin);
			$mtime = date('d/m/Y H:i', $lstat['mtime']);
			return $mtime;
       		
       	}
       	
        function getTailleDossier($chemin) {
        	$this->_Size = 0;
        	//$lstat = lstat($chemin);
        	//$this->_Size += $lstat['size'];
        	//echo $this->_Size;
        	$pDossier = opendir($chemin);
        	while($file = readdir($pDossier)){
        		if($file != '.' && $file != '..') {
        			$pathfile = $chemin.'/'.$file;
        			$lstat = lstat($pathfile);
        			//echo $lstat['size'];
        			$this->_Size += $lstat['size'];
        		}
        	}
        	closedir($pDossier);

        }
        
        function getSize() {
        	return $this->_Size;
        }
        
        function setChemin($c) {
        	$this->_CheminUser = $c;
        }
        
        function getArborescenceDossier() {
        	$this->ArborescenceDossier($this->_CheminUser);
        	return $this->_ArborescenceDossier;
        } 
        
		function AddDossier() {
			$chemin = '../nova/TestN1';
			if(!mkdir($chemin,0600,true)) {
				echo "Echec lors de la création du répertoire";
			}
			else 
			{
				echo "Création réussi";
			}
		}
		
		function ArborescenceDossier($chemin) {
			$lstat = lstat($chemin);
			$this->_SizeTotal += $lstat['size'];
			$folder = opendir ($chemin);
			 
			while ($file = readdir($folder)) {
				if ($file != "." && $file != "..") {
					$pathfile = $chemin.'/'.$file;
					//if(filetype($pathfile) == 'dir'){
						$this->_ArborescenceDossier[] = $file;
						//$this->ArborescenceDossier($pathfile);
					/*} else if(filetype($pathfile) == 'file') {
						$this->_Arborescence[][] = $file;
					}*/
				}
			}
			closedir ($folder);  
		}
		
		function Arborescence($chemin) {
			$lstat = lstat($chemin);
			
			 //echo $chemin ."   type : ".$filetype." - size : ".$lstat['size']." - mtime : ".$mtime.'<br/>';
			 $this->_SizeTotal += $lstat['size'];
			 $this->_SizeTotalOctet += $lstat['size']; 	
			 if(is_dir($chemin)) {
			 	$me = opendir($chemin);
				while($child = readdir($me)) {
			 		//echo $child;
			 		if($child != '.' && $child != '..') {
						
			 			$this->Arborescence($chemin.DIRECTORY_SEPARATOR.$child);
			 		}
				}
			 }
		}
		
		function CalculTaille($nombre) {
			$Octet = 1;
			$KiloOctet = 1024 * $Octet;
			$MegaOctet = 1024 * $KiloOctet;
			$GigaOctet = 1024 * $MegaOctet;
			
				
			if($nombre  >= $KiloOctet ) {
				if($nombre  >= $MegaOctet) {
					if($nombre >= $GigaOctet) {
						$nombre = $this->_SizeTotal / $GigaOctet;
						$nombre = round($nombre);
						$nombre = $nombre." Go";
					} else {
						$nombre = $nombre / $MegaOctet;
						$nombre = round($nombre);
						$nombre = $nombre." Mo";
					}
				} else {
					$nombre = $nombre / $KiloOctet;
					$nombre = round($nombre);
					$nombre = $nombre." Ko";
				}
			} else {
				$nombre = $nombre." O";
			}
			return $nombre;
		}
		
		function getTailleTotal() {
			$Octet = 1;
			$KiloOctet = 1024 * $Octet;
			$MegaOctet = 1024 * $KiloOctet;
			$GigaOctet = 1024 * $MegaOctet;
			
			$this->Arborescence($this->_CheminUser);
			
			if($this->_SizeTotal  >= $KiloOctet ) {
				if($this->_SizeTotal  >= $MegaOctet) {
					if($this->_SizeTotal >= $GigaOctet) {
						$this->_SizeTotal = $this->_SizeTotal / $GigaOctet;
						$this->_SizeTotal = round($this->_SizeTotal,2);
						$this->_SizeTotal = $this->_SizeTotal." Go";
					} else {
						$this->_SizeTotal = $this->_SizeTotal / $MegaOctet;
						$this->_SizeTotal = round($this->_SizeTotal,2);
						$this->_SizeTotal = $this->_SizeTotal." Mo";
					}
				} else {
					$this->_SizeTotal = $this->_SizeTotal / $KiloOctet;
					$this->_SizeTotal = round($this->_SizeTotal,2);
					$this->_SizeTotal = $this->_SizeTotal." Ko";
				}
			} else {
				$this->_SizeTotal = $this->_SizeTotal." O";
			}
		}
        
        function getTaille() {
            
            $this->getTailleTotal();
            
            return $this->_SizeTotal;
        }
    }
?>