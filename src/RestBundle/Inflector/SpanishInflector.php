<?php
namespace RestBundle\Inflector;

use Doctrine\Common\Inflector\Inflector;
use FOS\RestBundle\Inflector\InflectorInterface;

/**
 * Class SpanishInflector
 * @package RestBundle\Inflector
 */
class SpanishInflector implements InflectorInterface {

    /**
     * @var array
     */
    private $pluralizedWords = array(
        'Comentario' => 'comentarios'
    );

    /**
     * Pluralizes noun.
     *
     * @param string $word
     *
     * @return string
     */
    public function pluralize($word) {
        if(array_key_exists($word, $this->pluralizedWords)) {
            return $this->pluralizedWords[$word];
        }
        return Inflector::pluralize($word);
    }
}