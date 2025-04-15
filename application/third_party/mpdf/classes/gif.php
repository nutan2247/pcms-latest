<?php
///////////////////////////////////////////////////////////////////////////////////////////////////
// 2009-12-22 Adapted for mPDF 4.2
///////////////////////////////////////////////////////////////////////////////////////////////////
// GIF Util - (C) 2003 Yamasoft (S/C)
// http://www.yamasoft.com
// All Rights Reserved
// This file can be freely copied, distributed, modified, updated by anyone under the only
// condition to leave the original address (Yamasoft, http://www.yamasoft.com) and this header.
///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
// 2009-12-22 Adapted INB 
// Functions calling functionname($x, $len = 0) were not working on PHP5.1.5 as pass by reference
// All edited to $len = 0; then call function.
///////////////////////////////////////////////////////////////////////////////////////////////////


///////////////////////////////////////////////////////////////////////////////////////////////////

class CGIFLZW
{
	var $MAX_LZW_BITS;
	var $Fresh, $CodeSize, $SetCodeSize, $MaxCode, $MaxCodeSize, $FirstCode, $OldCode;
	var $ClearCode, $EndCode, $Next, $Vals, $Stack, $sp, $Buf, $CurBit, $LastBit, $Done, $LastByte;

	///////////////////////////////////////////////////////////////////////////

	// CONSTRUCTOR
	public function __construct()
	{
		$this->MAX_LZW_BITS = 12;
		unSet($this->Next);
//@@ -41,8 +39,6 @@ function CGIFLZW()
		$this->Buf = range(0, 279);
	}

	///////////////////////////////////////////////////////////////////////////

function deCompress($data, &$datLen)
	{
		$stLen = strlen($data);
//@@ -65,7 +61,6 @@ function deCompress($data, &$datLen)
		return $ret;
	}

	///////////////////////////////////////////////////////////////////////////
function LZWCommandInit(&$data, &$dp)
	{
		$this->SetCodeSize = ord($data[0]);
//@@ -176,8 +171,6 @@ function LZWCommand(&$data, &$dp)
		return $Code;
	}

	function LZWCommand(&$data, &$dp)
	{
		if($this->Fresh) {
			$this->Fresh = 0;
			do {
				$this->FirstCode = $this->GetCode($data, $dp);
				$this->OldCode   = $this->FirstCode;
			}
			while($this->FirstCode == $this->ClearCode);

			return $this->FirstCode;
		}

		if($this->sp > 0) {
			$this->sp--;
			return $this->Stack[$this->sp];
		}

		while(($Code = $this->GetCode($data, $dp)) >= 0) {
			if($Code == $this->ClearCode) {
				for($i = 0; $i < $this->ClearCode; $i++) {
					$this->Next[$i] = 0;
					$this->Vals[$i] = $i;
				}

				for(; $i < (1 << $this->MAX_LZW_BITS); $i++) {
					$this->Next[$i] = 0;
					$this->Vals[$i] = 0;
				}

				$this->CodeSize    = $this->SetCodeSize + 1;
				$this->MaxCodeSize = $this->ClearCode << 1;
				$this->MaxCode     = $this->ClearCode + 2;
				$this->sp          = 0;
				$this->FirstCode   = $this->GetCode($data, $dp);
				$this->OldCode     = $this->FirstCode;

				return $this->FirstCode;
			}

			if($Code == $this->EndCode) {
				return -2;
			}

			$InCode = $Code;
			if($Code >= $this->MaxCode) {
				$this->Stack[$this->sp++] = $this->FirstCode;
				$Code = $this->OldCode;
			}

			while($Code >= $this->ClearCode) {
				$this->Stack[$this->sp++] = $this->Vals[$Code];

				if($Code == $this->Next[$Code]) // Circular table entry, big GIF Error!
					return -1;

				$Code = $this->Next[$Code];
			}

			$this->FirstCode = $this->Vals[$Code];
			$this->Stack[$this->sp++] = $this->FirstCode;

			if(($Code = $this->MaxCode) < (1 << $this->MAX_LZW_BITS)) {
				$this->Next[$Code] = $this->OldCode;
				$this->Vals[$Code] = $this->FirstCode;
				$this->MaxCode++;

				if(($this->MaxCode >= $this->MaxCodeSize) && ($this->MaxCodeSize < (1 << $this->MAX_LZW_BITS))) {
					$this->MaxCodeSize *= 2;
					$this->CodeSize++;
				}
			}

			$this->OldCode = $InCode;
			if($this->sp > 0) {
				$this->sp--;
				return $this->Stack[$this->sp];
			}
		}

		return $Code;
	}

	///////////////////////////////////////////////////////////////////////////

	function GetCodeInit(&$data, &$dp)
	{
		$this->CurBit = 0;
//@@ -229,25 +222,19 @@ function GetCode(&$data, &$dp)

}

	function GetCode(&$data, &$dp)
	{
		if(($this->CurBit + $this->CodeSize) >= $this->LastBit) {
			if($this->Done) {
				if($this->CurBit >= $this->LastBit) {
					// Ran off the end of my bits
					return 0;
				}
				return -1;
			}

			$this->Buf[0] = $this->Buf[$this->LastByte - 2];
			$this->Buf[1] = $this->Buf[$this->LastByte - 1];

			$Count = ord($data[$dp]);
			$dp += 1;

			if($Count) {
				for($i = 0; $i < $Count; $i++) {
					$this->Buf[2 + $i] = ord($data[$dp+$i]);
				}
				$dp += $Count;
			}
			else {
				$this->Done = 1;
			}

			$this->LastByte = 2 + $Count;
			$this->CurBit   = ($this->CurBit - $this->LastBit) + 16;
			$this->LastBit  = (2 + $Count) << 3;
		}

		$iRet = 0;
		for($i = $this->CurBit, $j = 0; $j < $this->CodeSize; $i++, $j++) {
			$iRet |= (($this->Buf[intval($i / 8)] & (1 << ($i % 8))) != 0) << $j;
		}

		$this->CurBit += $this->CodeSize;
		return $iRet;
	}
}

///////////////////////////////////////////////////////////////////////////////////////////////////

class CGIFCOLORTABLE
{
	var $m_nColors;
	var $m_arColors;

	///////////////////////////////////////////////////////////////////////////

	// CONSTRUCTOR
	public function __construct()
	{
		unSet($this->m_nColors);
		unSet($this->m_arColors);
	}

	///////////////////////////////////////////////////////////////////////////

	function load($lpData, $num)
	{
		$this->m_nColors = 0;
//@@ -266,8 +253,6 @@ function load($lpData, $num)
		return true;
	}

	///////////////////////////////////////////////////////////////////////////

	function toString()
	{
		$ret = "";
  //@@ -282,8 +267,6 @@ function toString()
		return $ret;
	}

	///////////////////////////////////////////////////////////////////////////

	function colorIndex($rgb)
	{
		$rgb = intval($rgb) & 0xFFFFFF;
//@@ -309,8 +292,6 @@ function colorIndex($rgb)

}
}

///////////////////////////////////////////////////////////////////////////////////////////////////

class CGIFFILEHEADER
{
	var $m_lpVer;
	var $m_nWidth;
	var $m_nHeight;
	var $m_bGlobalClr;
	var $m_nColorRes;
	var $m_bSorted;
	var $m_nTableSize;
	var $m_nBgColor;
	var $m_nPixelRatio;
	var $m_colorTable;

	///////////////////////////////////////////////////////////////////////////

	// CONSTRUCTOR
	public function __construct()
	{
		unSet($this->m_lpVer);
		unSet($this->m_nWidth);
//@@ -350,8 +329,6 @@ function CGIFFILEHEADER()
		unSet($this->m_colorTable);
	}

	///////////////////////////////////////////////////////////////////////////

	function load($lpData, &$hdrLen)
	{
		$hdrLen = 0;
//@@ -387,17 +364,13 @@ function load($lpData, &$hdrLen)
		return true;
	}

	///////////////////////////////////////////////////////////////////////////

	function w2i($str)
	{
		return ord(substr($str, 0, 1)) + (ord(substr($str, 1, 1)) << 8);
	}
}

///////////////////////////////////////////////////////////////////////////////////////////////////

class CGIFIMAGEHEADER
{
	var $m_nLeft;
	var $m_nTop;
	var $m_nWidth;
	var $m_nHeight;
	var $m_bLocalClr;
	var $m_bInterlace;
	var $m_bSorted;
	var $m_nTableSize;
	var $m_colorTable;

	///////////////////////////////////////////////////////////////////////////

	// CONSTRUCTOR
	public function __construct()
	{
		unSet($this->m_nLeft);
		unSet($this->m_nTop);
		unSet($this->m_nWidth);
		unSet($this->m_nHeight);
		unSet($this->m_bLocalClr);
		unSet($this->m_bInterlace);
		unSet($this->m_bSorted);
		unSet($this->m_nTableSize);
		unSet($this->m_colorTable);
	}

	///////////////////////////////////////////////////////////////////////////

	function load($lpData, &$hdrLen)
	{
		$hdrLen = 0;

		$this->m_nLeft   = $this->w2i(substr($lpData, 0, 2));
		$this->m_nTop    = $this->w2i(substr($lpData, 2, 2));
		$this->m_nWidth  = $this->w2i(substr($lpData, 4, 2));
		$this->m_nHeight = $this->w2i(substr($lpData, 6, 2));

		if(!$this->m_nWidth || !$this->m_nHeight) {
			return false;
		}

		$b = ord($lpData{8});
		$this->m_bLocalClr  = ($b & 0x80) ? true : false;
		$this->m_bInterlace = ($b & 0x40) ? true : false;
		$this->m_bSorted    = ($b & 0x20) ? true : false;
		$this->m_nTableSize = 2 << ($b & 0x07);
		$hdrLen = 9;

		if($this->m_bLocalClr) {
			$this->m_colorTable = new CGIFCOLORTABLE();
			if(!$this->m_colorTable->load(substr($lpData, $hdrLen), $this->m_nTableSize)) {
				return false;
			}
			$hdrLen += 3 * $this->m_nTableSize;
		}

		return true;
	}

	///////////////////////////////////////////////////////////////////////////

	function w2i($str)
	{
		return ord(substr($str, 0, 1)) + (ord(substr($str, 1, 1)) << 8);
	}
}

///////////////////////////////////////////////////////////////////////////////////////////////////

class CGIFIMAGE
{
	var $m_disp;
	var $m_bUser;
	var $m_bTrans;
	var $m_nDelay;
	var $m_nTrans;
	var $m_lpComm;
	var $m_gih;
	var $m_data;
	var $m_lzw;

	///////////////////////////////////////////////////////////////////////////

	public function __construct()
	{
		unSet($this->m_disp);
		unSet($this->m_bUser);
		unSet($this->m_bTrans);
		unSet($this->m_nDelay);
		unSet($this->m_nTrans);
		unSet($this->m_lpComm);
		unSet($this->m_data);
		$this->m_gih = new CGIFIMAGEHEADER();
		$this->m_lzw = new CGIFLZW();
	}

	///////////////////////////////////////////////////////////////////////////

	function load($data, &$datLen)
	{
		$datLen = 0;

		while(true) {
			$b = ord($data[0]);
			$data = substr($data, 1);
			$datLen++;

			switch($b) {
			case 0x21: // Extension
				$len = 0;
				if(!$this->skipExt($data, $len)) {
					return false;
				}
				$datLen += $len;
				break;

			case 0x2C: // Image
				// LOAD HEADER & COLOR TABLE
				$len = 0;
				if(!$this->m_gih->load($data, $len)) {
					return false;
				}
				$data = substr($data, $len);
				$datLen += $len;

				// ALLOC BUFFER
				$len = 0;

				if(!($this->m_data = $this->m_lzw->deCompress($data, $len))) {
					return false;
				}

				$data = substr($data, $len);
				$datLen += $len;

				if($this->m_gih->m_bInterlace) {
					$this->deInterlace();
				}

				return true;

			case 0x3B: // EOF
			default:
				return false;
			}
		}
		return false;
	}

	///////////////////////////////////////////////////////////////////////////

	function skipExt(&$data, &$extLen)
	{
		$extLen = 0;

		$b = ord($data[0]);
		$data = substr($data, 1);
		$extLen++;

		switch($b) {
		case 0xF9: // Graphic Control
			$b = ord($data[1]);
			$this->m_disp   = ($b & 0x1C) >> 2;
			$this->m_bUser  = ($b & 0x02) ? true : false;
			$this->m_bTrans = ($b & 0x01) ? true : false;
			$this->m_nDelay = $this->w2i(substr($data, 2, 2));
			$this->m_nTrans = ord($data[4]);
			break;

		case 0xFE: // Comment
			$this->m_lpComm = substr($data, 1, ord($data[0]));
			break;

		case 0x01: // Plain text
			break;

		case 0xFF: // Application
			break;
		}

		// SKIP DEFAULT AS DEFS MAY CHANGE
		$b = ord($data[0]);
		$data = substr($data, 1);
		$extLen++;
		while($b > 0) {
			$data = substr($data, $b);
			$extLen += $b;
			$b    = ord($data[0]);
			$data = substr($data, 1);
			$extLen++;
		}
		return true;
	}

	///////////////////////////////////////////////////////////////////////////

	function w2i($str)
	{
		return ord(substr($str, 0, 1)) + (ord(substr($str, 1, 1)) << 8);
	}

	///////////////////////////////////////////////////////////////////////////

	function deInterlace()
	{
		$data = $this->m_data;

		for($i = 0; $i < 4; $i++) {
			switch($i) {
			case 0:
				$s = 8;
				$y = 0;
				break;

			case 1:
				$s = 8;
				$y = 4;
				break;

			case 2:
				$s = 4;
				$y = 2;
				break;

			case 3:
				$s = 2;
				$y = 1;
				break;
			}

			for(; $y < $this->m_gih->m_nHeight; $y += $s) {
				$lne = substr($this->m_data, 0, $this->m_gih->m_nWidth);
				$this->m_data = substr($this->m_data, $this->m_gih->m_nWidth);

				$data =
					substr($data, 0, $y * $this->m_gih->m_nWidth) .
					$lne .
					substr($data, ($y + 1) * $this->m_gih->m_nWidth);
			}
		}

		$this->m_data = $data;
	}
}

///////////////////////////////////////////////////////////////////////////////////////////////////

class CGIF
{
	var $m_gfh;
	var $m_lpData;
	var $m_img;
	var $m_bLoaded;

	///////////////////////////////////////////////////////////////////////////

	// CONSTRUCTOR
	public function __construct()
	{
		$this->m_gfh     = new CGIFFILEHEADER();
		$this->m_img     = new CGIFIMAGE();
		$this->m_lpData  = "";
		$this->m_bLoaded = false;
	}

	///////////////////////////////////////////////////////////////////////////
	function ClearData() {
		$this->m_lpData = '';
		unSet($this->m_img->m_data);
		unSet($this->m_img->m_lzw->Next);
		unSet($this->m_img->m_lzw->Vals);
		unSet($this->m_img->m_lzw->Stack);
		unSet($this->m_img->m_lzw->Buf);
	}

	function loadFile(&$data, $iIndex)
	{
		if($iIndex < 0) {
			return false;
		}
		$this->m_lpData = $data;

		// GET FILE HEADER
		$len = 0;
		if(!$this->m_gfh->load($this->m_lpData, $len)) {
			return false;
		}

		$this->m_lpData = substr($this->m_lpData, $len);

		do {
			$imgLen = 0;
			if(!$this->m_img->load($this->m_lpData, $imgLen)) {
				return false;
			}
			$this->m_lpData = substr($this->m_lpData, $imgLen);
		}
		while($iIndex-- > 0);

		$this->m_bLoaded = true;
		return true;
	}

}

///////////////////////////////////////////////////////////////////////////////////////////////////

?>