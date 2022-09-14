<?php
class PAGINADOR
{
	var $sql,$records,$pages;
	/*
	Variables that are passed via constructor parameters
	*/
	var $pagina,$total,$limit,$first,$previous,$next,$last,$start,$end;
	/*
	Variables that will be computed inside constructor
	*/
	function PAGINADOR($sql,$con)
	{
		$records=10;
		$pages=8;
		if($pages%2==0)
			$pages++;
	
		$res=mysqli_query($con,$sql);
		$total=mysqli_num_rows($res);
		$pagina=isset($_GET["pagina"])?$_GET["pagina"]:1;
	
		$limit=($pagina-1)*$records;
		$sql.=" limit $limit,$records";
	
		$first=1;
		$previous=$pagina>1?$pagina-1:1;
		$next=$pagina+1;
		$last=ceil($total/$records);
		if($next>$last)
			$next=$last;
	
		$start=$pagina;
		$end=$start+$pages-1;
		if($end>$last)
			$end=$last;
		
		if(($end-$start+1)<$pages)
		{
			$start-=$pages-($end-$start+1);
			if($start<1)
				$start=1;
		}
		if(($end-$start+1)==$pages)
		{
			$start=$pagina-floor($pages/2);
			$end=$pagina+floor($pages/2);
			while($start<$first)
			{
				$start++;
				$end++;
			}
			while($end>$last)
			{
				$start--;
				$end--;
			}
		}
	
		$this->sql=$sql;
		$this->records=$records;
		$this->pages=$pages;
		$this->pagina=$pagina;
		$this->total=$total;
		$this->limit=$limit;
		$this->first=$first;
		$this->previous=$previous;
		$this->next=$next;
		$this->last=$last;
		$this->start=$start;
		$this->end=$end;
	}
	function ver_pagina($url,$params="")
	{
		$pagina2="";
		if($this->total>$this->records)
		{
			$pagina=$this->pagina;
			$first=$this->first;
			$previous=$this->previous;
			$next=$this->next;
			$last=$this->last;
			$start=$this->start;
			$end=$this->end;
			if($params=="")
				$params="?pagina=";
			else
				$params="?$params&pagina=";
			$pagina2.="<ul class='pagination paginador'>";
			$pagina2.="<li class='paginador-current btn btn-primary'>Página $pagina de $last</li>";
			if($pagina==$first)
				$pagina2.="<li class='paginador-first paginador-disabled'><a href='javascript:void(0)'>&lt;&lt;</a></li>";
			else
				$pagina2.="<li class='paginador-first'><a href='$url$params$first'>&lt;&lt;</a></li>";
			if($pagina==$previous)
				$pagina2.="<li class='paginador-previous paginador-disabled'><a href='javascript:void(0)'>&lt;</a></li>";
			else
				$pagina2.="<li class='paginador-previous'><a href='$url$params$previous'>&lt;</a></li>";
			for($p=$start;$p<=$end;$p++)
			{
				$pagina2.="<li";
				if($pagina==$p)
					$pagina2.=" class='paginador-active'";
				$pagina2.="><a href='$url$params$p'>$p</a></li>";
			}
			if($pagina==$next)
				$pagina2.="<li class='paginador-next paginador-disabled'><a href='javascript:void(0)'>&gt;</a></li>";
			else
				$pagina2.="<li class='paginador-next'><a href='$url$params$next'>&gt;</a></li>";
			if($pagina==$last)
				$pagina2.="<li class='paginador-last paginador-disabled'><a href='javascript:void(0)'>&gt;&gt;</a></li>";
			else
				$pagina2.="<li class='paginador-last'><a href='$url$params$last'>&gt;&gt;</a></li>";
			$pagina2.="</ul>";
		}
		return $pagina2;
	}
}
?>