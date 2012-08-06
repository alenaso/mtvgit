<?php

class Paginador {
	var $href;
	var $pagina;
	var $cantidadXPagina;
	var $total;
	var $pagina_inicial;
	var $paginas_mostradas;
	
	var $PAGINAS_A_LA_VISTA = 5;
	
	public function __construct($href, $pag, $cant, $tot) {
	
		$this->href = $href;
	
		//por defecto pagina 0
		if (!is_int((int)$pag))
			$pag = 0;
		
		if ($pag < 0)
			$pag = 0;
		
		$this->pagina = $pag;
		$this->cantidadXPagina = $cant;
		$this->total = $tot;
		$this->paginas_mostradas = 0;
		
		$this->pagina_inicial = $this->pagina - 2;

		if (($this->pagina_inicial + ($this->PAGINAS_A_LA_VISTA - 1)) > $this->getUltimaPagina())
			$this->pagina_inicial = $this->getUltimaPagina() - ($this->PAGINAS_A_LA_VISTA - 1);

		if ($this->pagina_inicial < 0)
			$this->pagina_inicial = 0;
	}
	
	public function getLimiteMenor() {
		$prim = $this->pagina * $this->cantidadXPagina;
		
		if ($prim > $this->total) {
			return 0;
		}
			
		return $prim;
	}
	
	public function getLimiteMayor() {
		$prim = $this->pagina * $this->cantidadXPagina;
		if ($prim > $this->total){
			return 0;
		}else{
			$ult = $prim + $this->cantidadXPagina;
			if ($ult > $this->total)
				return $this->total - $prim;
				
			return $ult - $prim;
		}
		
	}
	
	public function getCantidadPorPagina() {
		return $this->cantidadXPagina;
	}
	
	public function getAnterior() {
		if ($this->pagina >0)
			return ($this->pagina - 1);
		return -1;
	}
	
	public function getSiguiente() {
		if ($this->getLimiteMayor() > 0 && $this->total > ($this->getLimiteMenor() + $this->cantidadXPagina))
			return ($this->pagina + 1);
		return -1;
	}
	
	public function getUltimaPagina(){
		return ceil($this->total / $this->cantidadXPagina)-1;
	}
	
	public function getPaginaActual() {
		return $this->pagina;
	}
	
	public function getLinksPaginasGaleria($url){
		$result = "";
		$separador = "";
		
		for ($i = $this->pagina_inicial, $this->paginas_mostradas = 0; $i <= $this->getUltimaPagina() && $this->paginas_mostradas < $this->PAGINAS_A_LA_VISTA; $i++) { 
			if ($i == $this->pagina) { 
				// This is the current page. Don't make it a link.
				$result .= "<a class=\"selected\">".($i+1)."</a>";
			} else { 
				// This is not the current page. Make it a link. 
				$result .= "<a href=\"".$url."pid=".$i."\">".($i+1)."</a>";
			}
			
			$this->paginas_mostradas++;
			$separador = " - ";
		}
		
		if ($result == 1) {
			$result = "";
		}
		
		return $result;
	}
	
	public function getPuntosSuspensivos() {
		if ((($this->pagina + 2) < $this->getUltimaPagina()) && ($this->getUltimaPagina() > $this->paginas_mostradas)) 
			return "...";
		else
			return "";
	}
}
?>