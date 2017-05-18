<?php

abstract class Glyph
{
	protected $color;
	protected $size;
	protected $position;
	
	protected $character;
	
	/*
	 * В конструкторе устанавливаем общие свойства.
	 */
	function __construct($char)
	{
		$this->character = $char;
	}
	/*
	 * Через контекст передаем свойства, уникальные для каждого объекта.
	 */
	abstract public function draw($context);
}

class GlyphMail extends Glyph
{
	public function draw($context)
	{
		$this->color = $context['color'];
		$this->size = $context['size'];
		$this->position = $context['position'];
		
		// then draw itself
	}
}

class GlyphTwitter extends Glyph
{
	public function draw($context)
	{
		$this->color = $context['color'];
		$this->size = $context['size'];
		$this->position = $context['position'];
		
		// then draw itself
	}
}

class GlyphFlyWeight
{
	private $glyphes;
	
	public function getGlyphFactory($character)
	{
		if (!empty($this->glyphes[$character]))
		{
			return $this->glyphes[$character];
		}
		else
		{
			switch ($character)
			{
				case 'mail':
					$object = new GlyphMail();
					break;
				case 'twitter':
					$object = new GlyphTwitter();
					break;
			}
			
			$this->glyphes[$character] = $object;
			return $object;
		}
	}
}
