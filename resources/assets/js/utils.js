export function replaceManaText( text ) {
    text = text.replace( /\n/g, '<br /><br />' );
    text = text.replace( /\{T\}/g, '<i class="ms ms-tap ms-cost"></i>' );
    text = text.replace( /\{R\}/g, '<i class="ms ms-r ms-cost"></i>' );
    text = text.replace( /\{U\}/g, '<i class="ms ms-u ms-cost"></i>' );
    text = text.replace( /\{G\}/g, '<i class="ms ms-g ms-cost"></i>' );
    text = text.replace( /\{W\}/g, '<i class="ms ms-w ms-cost"></i>' );
    text = text.replace( /\{B\}/g, '<i class="ms ms-b ms-cost"></i>' );
    text = text.replace( /\{C\}/g, '<i class="ms ms-c ms-cost"></i>' );
    text = text.replace( /\{S\}/g, '<i class="ms ms-s ms-cost"></i>' );
    text = text.replace( /\{B\/P\}/g, '<i class="ms ms-p ms-cost"></i>' );
    text = text.replace( /\{E\}/g, '<i class="ms ms-e"></i>' );
    text = text.replace( /\{X\}/g, '<i class="ms ms-x ms-cost"></i>' );
    text = text.replace( /\{(\d+)\}/g, '<i class="ms ms-$1 ms-cost"></i>' );
    return text;
}

export function replaceManaCosts( cmc ) {
    cmc = cmc.replace( /\{R\}/g, '<i class="ms ms-r ms-cost ms-shadow ms-2x"></i> ' );
    cmc = cmc.replace( /\{U\}/g, '<i class="ms ms-u ms-cost ms-shadow ms-2x"></i> ' );
    cmc = cmc.replace( /\{G\}/g, '<i class="ms ms-g ms-cost ms-shadow ms-2x"></i> ' );
    cmc = cmc.replace( /\{W\}/g, '<i class="ms ms-w ms-cost ms-shadow ms-2x"></i> ' );
    cmc = cmc.replace( /\{B\}/g, '<i class="ms ms-b ms-cost ms-shadow ms-2x"></i> ' );
    cmc = cmc.replace( /\{C\}/g, '<i class="ms ms-c ms-cost ms-shadow ms-2x"></i> ' );
    cmc = cmc.replace( /\{S\}/g, '<i class="ms ms-s ms-cost ms-shadow ms-2x"></i> ' );
    cmc = cmc.replace( /\{X\}/g, '<i class="ms ms-x ms-cost ms-shadow ms-2x"></i> ' );
    cmc = cmc.replace( /\{B\/P\}/g, '<i class="ms ms-p ms-cost ms-shadow ms-2x"></i> ' );
    cmc = cmc.replace( /\{(\d+)\}/g, '<i class="ms ms-$1 ms-cost ms-shadow ms-2x"></i> ' );
    return cmc;
}
